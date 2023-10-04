<script setup>
import Logo from "@/Svg/Logo.vue";
import {inject, onMounted, ref} from "vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";
import HamburgerButton from "@/Layouts/Partials/HamburgerButton.vue";

let isScrolled = inject('isScrolled')
let showMobileMenu = inject('showMobileMenu')
let menu = [
    {
        'name' : 'Ремонт квартир',
        'href':'/',
        'subItems':
            [
                {'name':'Цены', 'href':'/ceny-na-remont-kvartir-pod-kliuc'},
                {
                    'name':'Этапы ремонта',
                    'href':'/etapy-remonta-kvartir-fotografii-i-opisanie',
                    'subItems':[
                        {'name':'Демонтажные работы', 'href':'/demontazhnye_raboty'},
                        {'name':'Устройство перегородок', 'href':'/demontazhnye_raboty'},
                        {'name':'Штукатурные работы', 'href':'/demontazhnye_raboty'},
                        {'name':'Устройство цементной стяжки', 'href':'/demontazhnye_raboty'},
                        {'name':'Гипсокартонные работы', 'href':'/demontazhnye_raboty'},
                        {'name':'Плиточные работы', 'href':'/demontazhnye_raboty'},
                        {'name':'Монтаж пластиковых окон', 'href':'/demontazhnye_raboty'},
                        {'name':'Шумоизоляция квартиры', 'href':'/demontazhnye_raboty'},
                    ],
                },
                {'name':'Портфолио', 'href':'/portfolio'},
                {'name':'Статьи', 'href':'/articles'},
            ],
    },
    {
        'name' : 'Отделка коттеджей',
        'href':'/otdelka_kottedjey',
        'subItems':
            [
                {'name':'Стоимость', 'href':'/otdelka_price'},
                {'name':'Портфолио', 'href':'/portfolio'},
                {'name':'Ремонт коттеджей', 'href':'/otdelka_etap'},
                {'name':'Ремонт таунхаусов', 'href':'/town_houses'},
                {'name':'Отделка фасада', 'href':'/otdelka-fasada'},
                {'name':'Ремонт деревянного дома', 'href':'/otdelka-fasada'},
                {'name':'Статьи', 'href':'/articles'},
            ],
    },
    {
        'name' : 'Дизайн интерьера',
        'href':'/dizayn-proekt',
        'subItems':
            [
                {'name':'Стоимость ', 'href':'/otdelka_price'},
                {'name':'Портфолио ', 'href':'/portfolio'},
                {'name':'Ремонт коттеджей ', 'href':'/otdelka_etap'},
                {'name':'Ремонт таунхаусов', 'href':'/town_houses'},
            ],
    },
    {'name' : 'Инженерные системы', 'href':'/inzenernye-sistemy' },
    {
        'name' : 'Компания',
        'href':'/',
        'subItems':
            [
                {'name':'Наше качество', 'href':'/otdelka_price'},
                {'name':'Отзывы ', 'href':'/otzyvy'},
                {'name':'Ремонт коттеджей ', 'href':'/otdelka_etap'},
                {'name':'Ремонт таунхаусов', 'href':'/town_houses'},
                {'name':'Отделка фасада', 'href':'/otdelka-fasada'},
                {'name':'Ремонт деревянного дома', 'href':'/otdelka-fasada'},
                {'name':'Статьи', 'href':'/articles'},
            ],

    },
];

</script>

<template>
    <!-- No Scroll -->
    <div class="fixed top-0 z-50 w-full px-6 md:px-10 bg-gray-50 flex justify-between gap-6 transition-all duration-300 items-center"
         :class="isScrolled ? 'h-16' : 'h-24'"
    >
        <!-- Logo -->
        <Link :href="route('home')" class="hover:text-ui-link-hover">
            <Logo class="mt-4 h-7 md:h-9 xl:h-12 shrink-0 transition-all"/>
        </Link>

        <!-- Menu -->
        <div class="hidden xl:flex h-full">
            <div v-for="item in menu" class="hover:text-ui-link-hover group/main h-full flex px-4 items-center">
                <Link :href="item.href" class="hover:text-ui-link-hover">{{ item.name }}</Link>
                <!--<Link :href="item.href" class="hover:text-ui-link-hover">{{ item.name }}</Link>-->
                <div v-if="item.subItems" class="hidden z-0 group-hover/main:block fixed w-full bg-[rgba(243,242,240,0.97)] left-0 h-32 transition-all duration-300" :class="isScrolled ? 'top-16' : 'top-24'"></div>
                <div v-if="item.subItems" class="hidden z-50 group-hover/main:block fixed h-32 transition-all duration-300" :class="isScrolled ? 'top-16' : 'top-24'">
                    <div class="flex flex-col flex-wrap h-full py-4">
                        <Link v-for="subItem in item.subItems"
                              :href="subItem.href" class="hover:text-ui-link-hover mb-2 mr-10 group/sub w-full text-[#909597] hover:text-[#353535] hover:underline"
                        >
                            <div class="flex items-center">
                                <div>{{ subItem.name }}</div>
                                <div v-if="subItem.subItems" class="ml-4 h-full">
                                    <CollapseIcon class="w-5 h-5 fill-indigo-500"/>
                                </div>
                            </div>
                            <div v-if="subItem.subItems" class="absolute h-0 w-0">

                                <div class="hidden group-hover/sub:flex flex-col space-y-3 text-[18px] text-[#909597] bg-white relative left-[150px] top-[-30px] px-8 py-4 w-[350px] shadow-xl">
                                    <div v-for="subSubItem in subItem.subItems" class="hover:text-black hover:underline transition-all duration-300">
                                        {{ subSubItem.name }}
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="flex space-x-4">
            <!-- Phone -->
            <div class="block md:hidden bg-[#1071ff] text-xs text-white px-6 py-3">
                +7&nbsp;(985)&nbsp;740-30-30
            </div>
            <div class="flex xl:hidden bg-black text-white w-[40px] md:w-[200px] justify-center md:justify-between  px-0 md:px-5 py-3 items-center cursor-pointer"
                 @click="showMobileMenu=!showMobileMenu"
            >
                <div class="hidden md:block text-lg">Меню</div>
                <HamburgerButton/>
            </div>
        </div>

        <!-- Right -->
        <div class="hidden md:flex space-x-8 items-center">
            <div class="hidden xl:flex">
                <Link :href="route('admin')" class="hover:text-ui-link-hover">+7&nbsp;(985)&nbsp;740-30-30</Link>
            </div>
            <Link :href="route('admin')" class="bg-[#1071ff] text-white px-6 py-3">Оставить&nbsp;заявку</Link>
        </div>
    </div>
</template>
