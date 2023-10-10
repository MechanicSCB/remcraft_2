<script setup>
import {router} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/LinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {ref} from "vue";
import ComponentsFilter from "@/Pages/Admin/Components/Partials/ComponentsFilter.vue";

let props = defineProps({components: Object});

let showedComponent = ref(props.components[0]);

let deleteComponent = (component) => {
    if (confirm('Вы действительно хотите удалить компонент: ' + component.title + '?')) {
        router.delete(route('components.destroy', component));
    }
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

                    <Link class="ml-12 my-2 btn btn-blue text-sm" :href="route('components.create')">Создать компонент</Link>
                </div>

                <!-- Filtering items -->
                <ComponentsFilter/>
            </div>

            <div class="pt-28 h-full">
                <div class="h-full overflow-y-auto pb-6">
                    <div v-for="component in components"
                         @click="showedComponent=component"
                         class="py-1 flex items-center space-x-4 text-xs hover:bg-blue-100 cursor-pointer"
                         :class="{'bg-blue-200':showedComponent===component}"
                    >
                        <span>{{ component.title }} - {{ component.type }} - с.{{ component.blocks[0]?.page_id ?? 0 }}</span>
                        <Link :href="route('components.edit', component.id)" class="hover:text-red-700">
                            <PencilIcon class="w-3.5"/>
                        </Link>
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

        <!-- RIGHT -->
        <iframe v-if="showedComponent?.blocks[0]" class="w-full" :src="'/blocks/' + showedComponent.blocks[0].id"></iframe>
        <iframe class="w-full" v-else :src="'/components/'+ showedComponent.id"></iframe>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}

</script>
