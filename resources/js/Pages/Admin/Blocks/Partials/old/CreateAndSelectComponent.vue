<script setup>
import {inject, ref} from "vue";
import {router, useForm} from "@inertiajs/vue3";

let blockForm = inject('form');

let showModal = ref(false);
let selectedComponent = ref(null);

let componentForm = useForm({
    title: '',
    slug: '',
    type: '',
    datum: {},
});

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
        <div v-if="!showModal" @click="showModal=true" class="btn">создать компонент</div>
    </div>

    <!-- Modal -->
    <div v-if="showModal"
         @click="showModal=false"
         class="fixed left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer">
        <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default  overflow-y-auto">
            <BlockComponentCreate/>
        </div>
    </div>
</template>
