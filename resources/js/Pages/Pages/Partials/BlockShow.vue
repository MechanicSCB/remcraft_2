<script setup>
import ComponentShow from "@/Pages/Pages/Partials/ComponentShow.vue";
import {onBeforeMount} from "vue";

let props = defineProps({block: Object});

onBeforeMount(() => {
    // Overwrite component's datum values with block's datum values
    if (['Pile', 'Gallery'].includes(props.block.component.type)) {
        props.block.component.datum = {...props.block.component.datum, ...props.block.datum};
    }
})
</script>
<template>
    <div :class="block.classes" class="overflow-hidden">
        <ComponentShow :class="block.inner_classes" :style="'padding:' + block.padding" :component="block.component"/>
    </div>
</template>
