<script setup>
import {inject, ref} from "vue";
import {router} from "@inertiajs/vue3";
import CreateNewBlockComponent from "@/Pages/Admin/Blocks/Partials/CreateNewBlockComponent.vue";

let form = inject('form');

let showModal = ref(false);
let selectedComponent = ref(router.page.props.components[form.component_id]);

let submit = (componentId) => {
    form.component_id = componentId;
    selectedComponent.value = router.page.props.components[form.component_id];
    showModal.value = false;
};
</script>
<template>
    <!-- The selected component and a button to display modal -->
    <div>
        <div v-if="selectedComponent">
            {{ selectedComponent.id }} - {{ selectedComponent?.title }} - {{ selectedComponent?.type }}
        </div>
        <div v-if="!showModal" @click="showModal=true" class="btn">выбрать компонент</div>
    </div>

    <!-- Modal -->
    <div v-if="showModal"
         @click="showModal=false"
         class="fixed left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer">
        <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default  overflow-y-auto">
            <CreateNewBlockComponent/>

            <!--  Components Table  -->
            <div v-for="component in $page.props.components" :key="component.id">

                <div @click="submit(component.id)" class="w-fit cursor-pointer hover:text-blue-500">
                    {{ component.id }} - {{ component.title }} - {{ component.type }}
                </div>
            </div>
        </div>
    </div>

</template>
