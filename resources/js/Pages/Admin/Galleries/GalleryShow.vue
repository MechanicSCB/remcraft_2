<script setup>
import GalleryImages from "@/Pages/Admin/Galleries/Partials/GalleryImages.vue";

defineProps({gallery: Object});
</script>
<template>
    <!-- Show gallery's images -->
    <GalleryImages :gallery="gallery"/>
</template>
