<script setup>
import ComponentShow from "@/Pages/Pages/Partials/ComponentShow.vue";

defineProps({block: Object});
</script>
<template>
    <div :class="block.classes" class="overflow-hidden">
        <ComponentShow :class="block.inner_classes" :style="'padding:' + block.padding" :component="block.component"/>
    </div>
</template>
