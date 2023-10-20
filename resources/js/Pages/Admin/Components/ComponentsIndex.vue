<script setup>
import {router} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/BlankLinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {ref} from "vue";
import IndexFilterComponents from "@/Pages/Admin/Components/Partials/IndexFilterComponents.vue";
import ModalEditComponent from "@/Pages/Admin/Components/Partials/ModalEditComponent.vue";

let props = defineProps({components: Object});

let showedComponent = ref(props.components[0]);

let deleteComponent = (component) => {
    router.delete(route('components.destroy', component), {
        onBefore: () => confirm('Вы действительно хотите удалить компонент: ' + component.title + '?'),
    });
}
</script>
<template>
    <Head title="Компоненты"/>

    <div class="flex h-screen">
        <!-- LEFT -->
        <div class="w-[350px] shrink-0 border-r h-screen">
            <div class="fixed">
                <div class="mt-3 flex items-center">
                    <h3 class="text-xl font-bold">Компоненты</h3>

                    <ModalEditComponent>
                        <div class="btn btn-blue text-center">Создать компонент</div>
                    </ModalEditComponent>
                </div>

                <!-- Filtering items -->
                <IndexFilterComponents/>
            </div>

            <!-- Components list -->
            <!-- TODO replace with table -->
            <div class="pt-28 h-full">
                <div class="h-full overflow-y-auto pb-6">
                    <div v-for="component in components"
                         @click="showedComponent=component"
                         class="py-1 flex items-center space-x-4 text-xs hover:bg-blue-100 cursor-pointer flex justify-between"
                         :class="{'bg-blue-200':showedComponent===component}"
                    >
                        <div>{{ component.title }} - {{ component.type }}</div>
                        <div class="flex gap-2">
                            <div class="flex">с. <span v-for="block in component.blocks">{{ block.page_id}};</span></div>
                            <!--<Link :href="route('components.edit', component.id)" class="hover:text-red-700">-->
                            <!--    <PencilIcon class="w-3.5"/>-->
                            <!--</Link>-->
                            <ModalEditComponent :component-id="component.id"><PencilIcon  class="w-3.5"/></ModalEditComponent>
                            <a :href="route('components.show', component.id)" class="hover:text-red-700" target="_blank">
                                <LinkIcon class="w-3.5"/>
                            </a>
                            <div @click="deleteComponent(component)" class="cursor-pointer hover:text-red-700">
                                <CloseCross class="w-4"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <iframe v-if="showedComponent?.blocks[0]" class="w-full" :src="'/blocks/' + showedComponent.blocks[0]?.id"></iframe>
        <iframe class="w-full" v-else :src="'/components/'+ showedComponent.id"></iframe>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}

</script>
