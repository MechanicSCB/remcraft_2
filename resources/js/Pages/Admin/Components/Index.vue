<script setup>
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({components: Object});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
<template>
    <Head title="Компоненты">
        <meta typeof="description" content="Компоненты">
    </Head>
    <h1 class="mt-3 text-3xl font-bold mb-6">Компоненты</h1>

    <PrimaryButton class="mb-4">
        <Link :href="route('components.create')">Создать компонент</Link>
    </PrimaryButton>

    <div v-for="component in components" class="flex space-x-4">
        <Link :href="route('components.show', component.slug)">{{ component.title }} - {{ component.type }}</Link>
        <Link :href="route('components.edit', component.id)">edit</Link>
        <button @click="router.delete(route('components.destroy', component))">del</button>
    </div>
</template>
