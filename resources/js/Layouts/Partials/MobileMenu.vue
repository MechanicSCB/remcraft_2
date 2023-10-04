<script setup>
import {inject, onMounted, ref} from "vue";
import ExpandIcon from "@/Svg/ExpandIcon.vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";

let isScrolled = inject('isScrolled');
let showMobileMenu = inject('showMobileMenu')
let expandedItem = ref(null);
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
                {'name':'Стоимость ', 'href':'/otdelka_price'},
                {'name':'Портфолио ', 'href':'/portfolio'},
                {'name':'Ремонт коттеджей ', 'href':'/otdelka_etap'},
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
    <div class="fixed z-50  w-full text-[#909597] bg-[#fbfafa] transition-all duration-300 overflow-y-auto max-h-screen"
         :class="isScrolled ? 'top-16' : 'top-24'"
    >
        <div v-for="(item, itemKey) in menu" class=" flex flex-col">
            <!-- Main Items -->
            <div class="px-10 border-t flex justify-between items-center" :class="expandedItem===itemKey ? 'bg-[#1071ff] text-white' : ''">
                <Link @click="showMobileMenu=false" class="w-full h-full py-4" :href="item.href">{{ item.name }}</Link>
                <CollapseIcon v-if="item.subItems && expandedItem!==itemKey" @click="expandedItem=itemKey" class="pt-1 w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
                <ExpandIcon v-if="item.subItems && expandedItem===itemKey" @click="expandedItem=null" class="w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
            </div>

            <!-- Expanded SubItems -->
            <div v-if="expandedItem===itemKey" v-for="(subItem, subItemKey) in item.subItems" class="pl-20 border-t flex justify-between items-center pr-10 bg-[rgba(232,232,232,0.54)]">
                <Link @click="showMobileMenu=false" class="w-full h-full py-4" :href="subItem.href">{{ subItem.name }}</Link>
                <CollapseIcon v-if="subItem.subItems" @click="expandedItem=itemKey + '.' + subItemKey" class="pt-1 w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
            </div>
        </div>
    </div>
</template>
