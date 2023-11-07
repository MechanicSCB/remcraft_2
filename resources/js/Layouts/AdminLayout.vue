<script setup>
import GlobeIcon from "@/Svg/GlobeIcon.vue";
import HomeIcon from "@/Svg/HomeIcon.vue";
import BlocksIcon from "@/Svg/BlocksIcon.vue";
import ImagesIcon from "@/Svg/ImagesIcon.vue";
import DiagramIcon from "@/Svg/DiagramIcon.vue";
import NodePlusIcon from "@/Svg/NodePlusIcon.vue";
import Flash from "@/Layouts/Partials/Flash.vue";
import RefreshIcon from "@/Svg/RefreshIcon.vue";
import {router} from "@inertiajs/vue3";
import LogoutIcon from "@/Svg/Logout.vue";
import AdminMenuItem from "@/Layouts/Partials/AdminMenuItem.vue";
import BackupRestore from "@/Svg/TipTap/BackupRestore.vue";
import CardAccountMail from "@/Svg/TipTap/CardAccountMail.vue";

let migrateFreshSeed = () => {
    router.post(route('migrate.fresh.seed'), {}, {
        onBefore: () => confirm('Вы действительно хотите вернуть все данные в исходное состояние?'),
    });
}
</script>

<template>
    <div class="flex">
        <Flash/>
        <!-- Left Menu -->
        <div id="admin-menu" class="pt-2 text-xs fixed h-full bg-black text-white w-6 1hover:w-28 overflow-hidden">
            <AdminMenuItem route-name="home" title="Сайт">
                <GlobeIcon/>
                Сайт
            </AdminMenuItem>

            <AdminMenuItem route-name="admin" title="Админ">
                <HomeIcon/>
                Админ
            </AdminMenuItem>

            <AdminMenuItem route-name="nodes.index" title="Меню">
                <DiagramIcon/>
                Меню
            </AdminMenuItem>

            <AdminMenuItem route-name="blocks.index" title="Блоки">
                <BlocksIcon/>
                Блоки
            </AdminMenuItem>

            <AdminMenuItem route-name="components.index" title="Компоненты">
                <NodePlusIcon/>
                Компоненты
            </AdminMenuItem>

            <AdminMenuItem route-name="galleries.index" title="Галереи">
                <ImagesIcon/>
                Галереи
            </AdminMenuItem>

            <AdminMenuItem route-name="bids.index" title="Заявки">
                <CardAccountMail :size="16"/>
                Заявки
            </AdminMenuItem>

            <Link href="" title="Обновить" preserve-scroll>
                <RefreshIcon class="-ml-0.5 w-5"/>
                Обновить
            </Link>
            <Link @click.prevent="router.post(route('logout'))" href="/logout" title="Выйти">
                <LogoutIcon :size="20"/>
                Выйти
            </Link>
            <Link @click.prevent="migrateFreshSeed" href="/migrateFreshSeed" class="!pl-0.5 bg-yellow-500 hover:!bg-yellow-600" title="Восстановить исходные данные">
                <BackupRestore :size="20"/>
                Восстановить
            </Link>
        </div>

        <main class="ml-10 w-full">
            <slot/>
        </main>
    </div>
</template>
<style>
#admin-menu a {
    @apply pl-1 py-1.5 w-28 flex items-center gap-2 hover:bg-gray-800;
}
</style>
