<script setup>
import ComponentShow from "@/Pages/Pages/Partials/ComponentShow.vue";

defineProps({component: Object});
</script>
<template>
    <ComponentShow :component="component"/>
</template>
