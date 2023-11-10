<script setup>
import {provide, ref} from "vue";
import TabBookmark from "@/Pages/Components/Calculator/TabBookmark.vue";
import TabBookmarkSmall from "@/Pages/Components/Calculator/TabBookmarkSmall.vue";
import Bid from "@/Pages/Components/Bid.vue";

let props = defineProps({datum:Object});
let activeTab = ref('standard');
let expandedRow = ref(-1);

let volume = ref(100);


function getPrice(item, index){
    let price = item*volume.value;

    for(let item of (props.datum.coefs ?? []).sort((a,b) => b.volume - a.volume)){
        if(volume.value >= item.volume) {
            price *= item.percent/100;
            break;
        }
    }

    if(index === 1) price=(Math.round(price/100)*100);

    return price;
}

function countSum(tabNum){
    let sum = [0,0];

    for (const item of props.datum.tabs[tabNum].table.rows) {
        sum[0]+=getPrice(item.row[1], 1);
        sum[1]+=getPrice(item.row[2], 2);
    }

    return sum;
}

provide('activeTab', activeTab)
</script>

<template>
    <div class="block-container mobile-px">
        <div class="pt-6 border">
            <!-- WIDE SCREEN BOOKMARKS -->
            <div class="hidden md:flex">
                <div class="px-6 w-3/4">
                    <h3 class="mb-6">{{ datum.title }}</h3>
                    <!-- BOOKMARKS  -->
                    <div class="flex flex-wrap text-[24px] font-light">
                        <TabBookmark v-for="tab in datum.tabs" :tabName="tab.slug">{{ tab.name }}</TabBookmark>
                    </div>
                </div>
                <div>
                    <h3 class="mb-6">Площадь помещения</h3>

                    <input class="max-w-[150px] mr-2" v-model="volume" type="number" step="10" min="10"> кв.м.
                </div>
            </div>

            <!-- MOBILE TITLE AND VOLUME INPUT -->
            <div class="flex md:hidden flex-col">
                <h3 class="w-full text-center text-xl">{{ datum.header }}</h3>
                <div>
                    <h3 class="my-6 w-full text-center ">Площадь помещения, м²</h3>

                    <input class="w-full md:max-w-[150px] mr-2" v-model="volume" type="number" step="10" min="10">
                </div>
            </div>

            <!-- TAB CONTENTS -->
            <div class="mt-9 text-ui-text-secondary text-[15px]">
                <div v-for="(tab, tabNum) in datum.tabs">
                    <TabBookmarkSmall :tabName="tab.slug">{{ tab.name }}</TabBookmarkSmall>
                    <div v-if="activeTab===tab.slug">
                        <div class="mb-6 px-6">
                            {{ tab.desc }}
                        </div>

                        <!-- Calc Table -->
                        <div class="hidden md:block">
                            <div class="h-16 bg-gray-100 flex border-t">
                                <div v-for="(value, index) in tab.table.head" :style="'width: '+ tab.table.widths[index]"
                                     class="pl-10 h-full flex border-r border-gray-300 items-center">
                                    {{ value }}
                                </div>
                            </div>
                            <div v-for="(value, rowNum) in tab.table.rows">
                                <div @click="expandedRow=expandedRow===rowNum ? false : rowNum" class="h-[34px] flex items-center border-t cursor-pointer">
                                    <div v-for="(item, index) in value.row"  :style="'width: '+ tab.table.widths[index]"
                                         class="pl-1 lg:pl-3 xl:pl-10 h-full flex border-b border-r border-gray-300 items-center">
                                        <span v-if="index>=1" :class="index ? '' : 'border-b border-dashed border-black'">{{ getPrice(item, index).toLocaleString() }} р</span>
                                        <span v-else :class="index ? '' : 'border-b border-dashed border-black'" class="leading-5">{{ item }}</span>
                                    </div>
                                </div>
                                <div v-if="expandedRow===rowNum" class="columns-2 px-10 py-4 text-sm">
                                    <div v-for="item in value.expand" class="mb-2 break-inside-avoid">
                                        <p>{{item.title}}</p>
                                        <span v-if="item.text" class="text-gray-600">{{item.text}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Price -->
                        <div class="block md:hidden text-[18px]">
                            <div v-for="(value, rowNum) in tab.table.rows" :class="rowNum%2 ? 'bg-gray-100' : ''" class="px-6">
                                <div class="border-b py-5">
                                    <div v-for="(item, index) in value.row" :class="index===0 ? 'mb-3' : ''">
                                    <span v-if="index===0"
                                          @click="expandedRow=expandedRow===rowNum ? false : rowNum"
                                          class="border-b border-dashed border-black cursor-pointer">
                                        {{ item }}
                                    </span>
                                        <span v-else class="">
                                        {{ tab.table.head[index] }}: {{ getPrice(item, index).toLocaleString() }} р
                                    </span>
                                    </div>
                                </div>
                                <div v-if="expandedRow===rowNum" class="columns-2 px-2  md:px-10 py-4 text-sm border-t">
                                    <div v-for="item in value.expand" class="mb-2 break-inside-avoid">
                                        <p>{{item.title}}</p>
                                        <span v-if="item.text" class="text-gray-600">{{item.text}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calc Footer -->
                        <div class="mt-6 bg-gray-200 py-10 px-8 flex flex-col md:flex-row md:items-center">
                            <div v-for="(value, index) in tab.table.head">
                                <div v-if="index" class="flex flex-col w-56 space-y-3">
                                    <h3 class="text-xl">{{value}}</h3>
                                    <span class="text-3xl">{{ countSum(tabNum)[index-1].toLocaleString() }}р</span>
                                    <span class="text-xs text-[#1071ff] cursor-pointer">Подробный перечень работ</span>
                                </div>
                            </div>
                            <Bid class="w-full md:w-fit mt-5 md:ml-24 flex items-center justify-center bg-[#1071ff]" :datum="{'slot':'Отправить заявку'}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
