<script setup>
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let props = defineProps({
    pages: Object,
});

</script>
<template>
    <Head title="Страницы сайта">
        <meta typeof="description" content="Страницы сайта">
    </Head>
    <h1 class="mt-3 text-3xl font-bold mb-6">Страницы</h1>

    <primary-button class="mb-4">
        <Link :href="route('pages.create')">Создать страницу</Link>
    </primary-button>

    <div v-for="page in pages" class="flex space-x-4">
        <Link :href="route('pages.show', page.slug)">{{ page.title }}</Link>
        <Link :href="route('pages.edit', page.id)">edit</Link>
        <button @click="router.delete(route('pages.destroy', page))">del</button>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
