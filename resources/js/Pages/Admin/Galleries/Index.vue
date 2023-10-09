<script setup>
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({galleries: Object});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
<template>
    <Head title="Компоненты">
        <meta typeof="description" content="Компоненты">
    </Head>
    <h1 class="mt-3 text-3xl font-bold mb-6">Галереи</h1>

    <PrimaryButton class="mb-4">
        <Link :href="route('galleries.create')">Создать галерею</Link>
    </PrimaryButton>

    <div v-for="gallery in galleries" class="flex space-x-4">
        <Link :href="route('galleries.show', gallery.id)">{{ gallery.title }}</Link>
        <Link :href="route('galleries.edit', gallery.id)">edit</Link>
        <button @click="router.delete(route('galleries.destroy', gallery))">del</button>
    </div>
</template>
