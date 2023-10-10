<script setup>
import Gallery from "@/Pages/Components/Gallery.vue";

defineProps({gallery: Object});
</script>
<template>
    <Gallery :galleries="[gallery]"/>
</template>
