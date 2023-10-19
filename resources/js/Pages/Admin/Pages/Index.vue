<script setup>
import Nodes from "@/Pages/Admin/Pages/Partials/Nodes.vue";
import {provide, ref} from "vue";

let openedNodes = ref(JSON.parse(sessionStorage.getItem('openedNodes')) ?? [1]);

provide('openedNodes', openedNodes)
</script>
<template>
    <Head title="Меню сайта">
        <meta typeof="description" content="Меню сайта">
    </Head>
    <h1 class="mt-3 text-3xl font-bold mb-6">Страницы</h1>

    <Link class="btn btn-green text-2xl font-bold pt-0 pb-0.5" :href="route('pages.create')">+</Link>

    <Nodes :parent="{'nodes':$page.props.menu}" type="page"/>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
