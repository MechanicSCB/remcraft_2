<script setup>

</script>

<template>
    <div class="flex">
        <!-- Left Menu -->
        <div class="min-h-screen h-full bg-red-50 flex flex-col">
            <Link :href="route('home')" class="hover:text-ui-link-hover">Сайт</Link>
            <Link :href="route('admin')" class="hover:text-ui-link-hover">Admin</Link>
            <Link :href="route('pages.index')" class="hover:text-ui-link-hover">Страницы</Link>
            <Link :href="route('components.index')" class="hover:text-ui-link-hover">Компоненты</Link>
            <Link :href="route('galleries.index')" class="hover:text-ui-link-hover">Галереи</Link>
            <Link :href="route('blocks.index')" class="hover:text-ui-link-hover">Блоки</Link>
        </div>

        <main class="w-full mx-10">
            <slot/>
        </main>
    </div>
</template>
