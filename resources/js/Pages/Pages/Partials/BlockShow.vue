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
    <div :id="'block_'+block.id"
        :class="block.classes"
        class="overflow-hidden"
        :style="block.style +'; padding-top:' + block.pt + 'px;' + 'padding-bottom:' + block.pb + 'px;'"
    >
        <ComponentShow :class="block.inner_classes" :component="block.component"/>
    </div>
</template>
