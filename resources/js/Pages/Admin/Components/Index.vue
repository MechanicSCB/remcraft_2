<script setup>
import {router, useForm} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/LinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import ComponentShow from "@/Pages/Pages/Partials/ComponentShow.vue";
import {ref} from "vue";
import BlockShow from "@/Pages/Pages/Partials/BlockShow.vue";
import ComponentsFilter from "@/Pages/Admin/Components/Partials/ComponentsFilter.vue";

let props = defineProps({components: Object});

let showedComponent = ref(props.components[0]);

let deleteComponent = (component) => {
    if(confirm('Вы действительно хотите удалить компонент: ' + component.title + '?')){
        router.delete(route('components.destroy', component));
    }
}
</script>
<template>
    <Head title="Компоненты"/>

    <div class="flex h-screen">
        <!-- LEFT -->
        <div class="w-[350px] shrink-0 border-r h-full overflow-y-auto">
            <h3 class="mt-3 text-xl font-bold mb-3">Компоненты</h3>

            <!-- Filtering items -->
            <ComponentsFilter/>

            <Link class="my-2 btn btn-blue" :href="route('components.create')">Создать компонент</Link>

            <div>
                <div v-for="component in components"
                     class="my-0.5 flex items-center space-x-4 text-xs"
                     :class="{'bg-blue-200':showedComponent===component}"
                >
                    <div @click="showedComponent=component"
                         class="cursor-pointer"

                    >
                        {{ component.title }} - {{ component.type }}
                    </div>
                    <Link :href="route('components.edit', component.id)">
                        <PencilIcon/>
                    </Link>
                    <a :href="route('components.show', component.id)" target="_blank"><LinkIcon/></a>
                    <button @click="deleteComponent(component)"><CloseCross/></button>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="main w-full h-full overflow-y-auto">
            <BlockShow v-if="showedComponent.block" :block="showedComponent.block"/>
            <ComponentShow v-else :class="{'mx-16':['Masonry','Pile'].includes(showedComponent.type)}" :component="showedComponent"/>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}

</script>
