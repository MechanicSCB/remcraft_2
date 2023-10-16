<script setup>

</script>
<template>
    <Head title="Меню сайта">
        <meta typeof="description" content="Меню сайта">
    </Head>
    <h1 class="mt-3 text-3xl font-bold mb-6">Меню</h1>

    <Link class="btn btn-green text-2xl font-bold pt-0 pb-0.5" :href="route('items.create')">+</Link>

    <div v-for="item in $page.props.menu" class="">
        {{ item.title }}

        <div v-for="subItem in item.sub_items" class="ml-4">
            {{ subItem.title }}

            <div v-for="subSubItem in subItem.sub_items" class="ml-4">
                {{ subSubItem.title }}
            </div>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
