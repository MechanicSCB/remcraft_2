<script setup>
import ComponentShow from "@/Pages/Pages/Partials/ComponentShow.vue";

defineProps({component: Object});
</script>
<template>
    <div class="px-2">
        <ComponentShow :component="component"/>
    </div>
</template>
