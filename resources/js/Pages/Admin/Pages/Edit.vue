<script setup>
import {router, useForm} from "@inertiajs/vue3";
import InputBlock from "@/Pages/Admin/Partials/InputBlock.vue";
import {provide} from "vue";

let props = defineProps({page: Object,});

let form = useForm({
    title: props.page.title,
    slug: props.page.slug,
    blocks: props.page.blocks,
});

provide('form', form);

let submit = () => {
    form.patch(route('pages.update', props.page));
};

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
    <Head title="Редактировать страницу"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-xl font-bold">Редактировать страницу</h1>

        <!-- Title&Slug Form -->
        <form @submit.prevent="submit">
            <div class="flex gap-2 items-center">
                <InputBlock label="Название страницы" field="title"/>
                <InputBlock field="slug"/>

                <button type="submit" class="btn btn-blue" :disabled="form.processing">Опубликовать</button>
            </div>
        </form>

        <!-- Page Blocks -->
        <div class="">
            <div v-for="(block, index) in page.blocks"
                 :key="block.id"
                 @drop.prevent="dragDrop($event,block.order)"
                 @dragstart="dragStart($event,block.id)"
                 @dragenter.prevent="dragEnter($event, $el)"
                 @dragover.prevent="dragOver($event, $el)"
                 draggable="true"
            >
                <Link :href="route('blocks.edit', block.id)" class="block border mb-2">
                    {{ block.order }} - {{ index }} - {{ block.id }} - {{ block.component.title }} - {{ block.component.type }}
                </Link>
            </div>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
