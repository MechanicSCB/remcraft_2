<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {provide, ref} from "vue";
import BlockShow from "@/Pages/Pages/Partials/BlockShow.vue";
import BlockForm from "@/Pages/Admin/Pages/Partials/BlockForm.vue";
import ArrowUpDown from "@/Svg/ArrowUpDown.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/BlankLinkIcon.vue";
import ValidationErrorsFlash from "@/Layouts/Partials/ValidationErrorsFlash.vue";
import PageNodes from "@/Pages/Admin/Pages/Partials/PageNodes.vue";

let props = defineProps({page: Object});

let form = useForm({
    title: props.page.title,
    slug: props.page.slug,
    blocks: props.page.blocks,
});

let openedNodes = ref(JSON.parse(sessionStorage.getItem('openedNodes')) ?? [1]);

provide('openedNodes', openedNodes)
provide('activePage', props.page)
provide('form', form);

let submit = () => {
    form.patch(route('pages.update', props.page));
};

let deletePage = (page) => {
    router.delete(route('pages.destroy', page), {
        onBefore: () => confirm('Вы действительно хотите удалить страницу: ' + page.id + ' : ' + page.title + ' вместе с блоками (' + page.blocks.length + ' шт.)?'),
    });
}

let deleteBlock = (block) => {
    if (confirm('Вы действительно хотите удалить блок: ' + block.id + '?')) {
        router.delete(route('blocks.destroy', block));
    }
}

let unboundedPages = () => Object.values(router.page.props.pages).filter((v) => !v.nodes.length);

// Drag and Drop Images
function dragStart(event, draggedBlockId) {
    event.dataTransfer.setData("draggedBlockId", draggedBlockId);
}

function dragEnter(event, el) {/* ev.preventDefault(); return true;*/
}

function dragOver(event, el) {/* ev.preventDefault();*/
}

function dragDrop(event, order) {
    router.post(route('blocks.reorder', [event.dataTransfer.getData("draggedBlockId"), order]));
}
</script>
<template>
    <Head :title="page.title + ' - редактировать'"/>

    <div class="">
        <!-- Header -->
        <div class="flex items-center gap-2">
            <!-- Title&Slug Form -->
            <form @submit.prevent="submit">
                <div class="my-2 flex gap-2 items-center">
                    <h1 class="text-xl font-bold">
                        <a :href="'/' + page.slug" target="_blank">Страница id:{{ page.id }}</a>
                    </h1>

                    <input class="ml-2 py-0 rounded border-gray-200 w-[450px]" v-model="form.title"/>
                    <input class="ml-2 py-0 rounded border-gray-200 w-[350px]" v-model="form.slug"/>

                    <ValidationErrorsFlash :errors="form.errors"/>

                    <button type="submit" class="hidden" :disabled="form.processing">Опубликовать</button>
                </div>
            </form>

            <!-- Add block button -->
            <Link :href="route('blocks.create',[{'page_id':page.id}])" class="btn btn-blue">+ Блок</Link>

            <!-- Delete page -->
            <div @click="deletePage(page)" class="ml-12 btn btn-red">Удалить страницу и блоки ({{ page.blocks.length }} шт.)</div>
        </div>

        <!-- Page Blocks -->
        <div class="flex pb-8">
            <!-- Left -->
            <div class="w-[250px] text-sm shrink-0">
                <Link class="btn btn-green text-2xl font-bold pt-0 pb-0.5" :href="route('pages.create')">+</Link>

                <PageNodes :parent="{'nodes':$page.props.menu}"/>

                <div v-if="unboundedPages().length" class="mt-4 font-bold mb-2">Непривязанные к меню страницы</div>
                <div v-for="unboundPage in unboundedPages()">
                    <Link class="hover:text-blue-500" :class="{'text-blue-600':unboundPage.id===page.id}" :href="route('pages.edit', unboundPage)">{{ unboundPage.title }}</Link>
                </div>
            </div>

            <!-- Right -->
            <div class="w-[750px]">
                <div v-for="(block, index) in page.blocks"
                     :key="block.id + '-' + block.order"
                     class="relative border border-blue-200 rounded flex items-center"
                     @drop.prevent="dragDrop($event,block.order)"
                     @dragenter.prevent="dragEnter($event, $el)"
                     @dragover.prevent="dragOver($event, $el)"
                >
                    <div class="absolute bg-white max-h-[120px] overflow-hidden w-full">
                        <BlockShow class="main scale-[0.5] origin-top-right" :block="block"/>
                    </div>

                    <div class="absolute top-1 left-1 w-8 h-12 text-sm">
                        id:{{ block.id }}
                    </div>

                    <ArrowUpDown class="relative ml-1 cursor-grab border hover:text-blue-500"
                                 @dragstart="dragStart($event,block.id)"
                                 draggable="true"
                    />

                    <BlockForm :block="block" class="relative ml-6"/>

                    <div class="px-2 py-2 absolute top-0 right-0 bg-[rgba(255,255,255,0.7)] flex gap-2">
                        <a :href="'/' + page.slug + '#block_' + block.id"
                           class="w-fit border rounded p-1 flex items-center bg-white text-sm font-bold text-black cursor-pointer hover:text-blue-500 gap-2"
                           target="_blank"
                        >
                            {{ block.component.type }}
                            <LinkIcon class="w-4"/>
                        </a>

                        <Link :href="route('blocks.edit', block.id)"
                              class="w-8 p-1.5 rounded text-white bg-yellow-400 hover:text-yellow-400 hover:bg-white cursor-pointer"
                        >
                            <PencilIcon/>
                        </Link>

                        <div @click="deleteBlock(block)"
                              class="w-8 text-white rounded bg-red-600 hover:text-red-600 hover:bg-white cursor-pointer"
                        >
                            <CloseCross/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
