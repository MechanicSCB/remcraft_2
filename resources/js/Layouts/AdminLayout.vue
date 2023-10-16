<script setup>
import PageIcon from "@/Svg/PageIcon.vue";
import GlobeIcon from "@/Svg/GlobeIcon.vue";
import HomeIcon from "@/Svg/HomeIcon.vue";
import BlocksIcon from "@/Svg/BlocksIcon.vue";
import ImagesIcon from "@/Svg/ImagesIcon.vue";
import DiagramIcon from "@/Svg/DiagramIcon.vue";
import NodePlusIcon from "@/Svg/NodePlusIcon.vue";
import Flash from "@/Layouts/Partials/Flash.vue";


</script>

<template>
    <div class="flex">
        <Flash/>
        <!-- Left Menu -->
        <div id="admin-menu" class="pt-2 text-xs fixed h-full bg-black text-white w-6 1hover:w-28 overflow-hidden">
            <Link :href="route('home')" class="" title="Сайт">
                <GlobeIcon/>
                Сайт
            </Link>
            <Link :href="route('admin')" class="" title="Admin">
                <HomeIcon/>
                Admin
            </Link>
            <Link :href="route('pages.index')" class="" title="Страницы">
                <PageIcon/>
                Страницы
            </Link>
            <Link :href="route('blocks.index')" class="" title="Блоки">
                <BlocksIcon/>
                Блоки
            </Link>
            <Link :href="route('components.index')" class="" title="Компоненты">
                <NodePlusIcon/>
                Компоненты
            </Link>
            <Link :href="route('galleries.index')" class="" title="Галереи">
                <ImagesIcon/>
                Галереи
            </Link>
            <Link :href="route('nodes.index')" class="" title="Меню">
                <DiagramIcon/>
                Меню
            </Link>
        </div>

        <main class="ml-10 w-full">
            <slot/>
        </main>
    </div>
</template>
<style>
#admin-menu a{
    @apply pl-1 py-1.5 w-28 flex items-center gap-2 hover:bg-gray-800;
}
</style>
