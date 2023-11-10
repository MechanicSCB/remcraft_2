<script setup>
import {router} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/BlankLinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {ref} from "vue";
import BlocksFilter from "@/Pages/Admin/Blocks/Partials/BlocksFilter.vue";

let props = defineProps({blocks: Object});

let showedBlock = ref(props.blocks[0]);

let deleteBlock = (block) => {
    if (confirm('Вы действительно хотите удалить блок: ' + block.component_id + '?')) {
        router.delete(route('blocks.destroy', block));
    }
}
</script>
<template>
    <Head title="Блоки"/>

    <div class="flex h-screen">
        <!-- LEFT -->
        <div class="w-[350px] shrink-0 border-r h-screen">
            <div class="fixed">
                <div class="mt-3 flex items-center">
                    <h3 class="text-xl font-bold">Блоки</h3>

                    <Link class="ml-12 my-2 btn btn-blue text-sm" :href="route('blocks.create')">Создать блок</Link>
                </div>

                <!-- Filtering items -->
                <BlocksFilter/>
            </div>

            <div class="pt-28 h-full">
                <div class="h-full overflow-y-auto pb-6">
                    <div v-for="block in blocks"
                         @click="showedBlock=block"
                         class="py-1 flex items-center space-x-4 text-xs hover:bg-blue-100 cursor-pointer"
                         :class="{'bg-blue-200':showedBlock===block}"
                    >
                        <span>{{ $page.props.components[block.component_id].title }} - {{ $page.props.components[block.component_id].type }}</span>
                        <Link :href="route('blocks.edit', block.id)" class="hover:text-red-700">
                            <PencilIcon class="w-3.5"/>
                        </Link>
                        <a :href="'/' + $page.props.pages[block.page_id].slug + '#block_' + block.id" class="hover:text-red-700" target="_blank">
                            <LinkIcon class="w-3.5"/>
                        </a>
                        <div @click="deleteBlock(block)" class="cursor-pointer hover:text-red-700">
                            <CloseCross class="w-4"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <iframe class="w-full" :src="'/blocks/'+ showedBlock.id"></iframe>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
