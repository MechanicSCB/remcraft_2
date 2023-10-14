<script setup>
import BlockShow from "@/Pages/Pages/Partials/BlockShow.vue";

defineProps({block: Object});
</script>
<template>
    <BlockShow :block="block"/>
</template>
