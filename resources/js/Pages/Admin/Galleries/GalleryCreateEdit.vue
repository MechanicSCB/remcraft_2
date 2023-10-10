<script setup>
import GalleryImages from "@/Pages/Admin/Galleries/Partials/GalleryImages.vue";
import UploadImages from "@/Pages/Admin/Galleries/Partials/UploadImages.vue";
import GalleryForm from "@/Pages/Admin/Galleries/Partials/GalleryForm.vue";

let props = defineProps({gallery: Object,});
</script>
<template>
    <Head :title="gallery ? 'Редактировать галерею' : 'Создать галерею'"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">{{ gallery ? 'Редактировать' : 'Создать' }} галерею</h1>

        <!-- Show gallery's images -->
        <GalleryImages :gallery="gallery"/>

        <!-- Upload Photos -->
        <UploadImages class="my-4" v-if="gallery" :gallery="gallery"/>

        <!-- Gallery form ('title', 'slug', 'component_id', ...) -->
        <GalleryForm :gallery="gallery"/>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
