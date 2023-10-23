<script setup>
import TabBookmark from "@/Pages/Admin/Components/Datum/Calculator/TabBookmark.vue";
import ExpandIcon from "@/Svg/ExpandIcon.vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";
import {provide, ref} from "vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import CloseCross from "@/Svg/CloseCross.vue";

let props = defineProps({modelValue:Object});
let activeTab = ref('standard');
let expandedRow = ref(-1);

provide('activeTab', activeTab)

</script>
<template>
    <div class="calculator-edit">
        <div class="pt-6 border">
            <!-- WIDE SCREEN BOOKMARKS -->
            <div class="flex">
                <div class="px-6 w-3/4">
                    <div class="flex">
                        <LabelInput v-model="modelValue['title']" placeholder="заголовок"/>

                        <div class="flex gap-2">
                            <div class="ml-4 btn " @click='(modelValue.coefs ??= []).push({"percent":100, "volume":null})'>
                                Добавить коэф.
                            </div>

                            <div>
                                <div class="flex gap-1" v-for="(coef, coefId) in modelValue.coefs">
                                    <LabelInput class="w-16" input-class="w-12" type="number" v-model="modelValue.coefs[coefId].percent" placeholder="%">%</LabelInput>
                                    <LabelInput input-class="w-16" type="number" v-model="modelValue.coefs[coefId].volume" placeholder="кв.м.">свыше кв.м.</LabelInput>
                                    <CloseCross @click="modelValue.coefs.splice(coefId, 1)" class="hover:text-red-600 w-6 mb-3 cursor-pointer" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn mb-4" @click='(modelValue.tabs ??= []).push({"desc": "", "name": "", "slug": "", "table": {"head": ["", "", ""], "rows": [{"row": ["", 0, 0], "expand": [{"text": "", "title": ""}]}], "widths": ["67%", "14%", "20%"]}})'>
                        Добавить вкладку
                    </div>

                    <!-- BOOKMARKS  -->
                    <div class="flex flex-wrap">
                        <div v-for="(tab, tabId) in modelValue.tabs">
                            <TabBookmark :tabName="tab.slug">
                                <input v-model="modelValue.tabs[tabId].name" type="text"
                                       class="h-full w-full text-[24px] border-0  font-light text-center border hover:bg-[#1071ff] transition-all duration-500"
                                       :class="activeTab===tab.slug?'bg-[#1071ff] text-white':' cursor-pointer'"
                                       placeholder="Имя вкладки"
                                       required
                                >
                            </TabBookmark>
                            <div class="max-w-full flex">
                                <input v-model="modelValue.tabs[tabId].slug" type="text"
                                       class="text-black"
                                       placeholder="слаг вкладки"
                                       required
                                >
                                <div @click="modelValue.tabs.splice(tabId, 1)"
                                     class="w-4 h-4 pl-1 font-bold bg-red-600 text-white rounded-full text-xs">
                                    ×
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="mb-6">Площадь помещения</h3>

                    <input class="max-w-[150px] mr-2" v-model="volume" type="number" step="10" min="10"> кв.м.
                </div>
            </div>

            <!-- TAB CONTENTS -->
            <div class="mt-9 text-ui-text-secondary text-[15px]">
                <div v-for="(tab, tabId) in modelValue.tabs">
                    <div v-if="activeTab===tab.slug">
                        <!-- Calc Description -->
                        <div class="px-6">
                            <textarea class="mb-6 w-full" id="title" v-model="modelValue.tabs[tabId]['desc']"/>
                        </div>

                        <!-- Calc Table -->
                        <div class="">
                            <!-- Table  Header-->
                            <div class="h-16 bg-gray-100 flex border-t">
                                <div v-for="(value, index) in tab.table.head"
                                     :style="'width: '+ tab.table.widths[index]"
                                     class="pl-10 h-full flex border-r border-gray-300 items-center">
                                    <input class="max-w-full bg-gray-100" id="title"
                                           v-model="modelValue.tabs[tabId].table.head[index]"
                                           :placeholder="'Имя столбца '+ (index + 1)"
                                    />
                                </div>
                            </div>
                            <div v-for="(value, rowNum) in tab.table.rows">
                                <!-- Row -->
                                <div class="h-[34px] flex items-center border-t">
                                    <div v-for="(item, index) in value.row" :style="'width: '+ tab.table.widths[index]"
                                         class="pl-1 lg:pl-3 xl:pl-4 h-full flex border-b border-r border-gray-300 items-center">
                                        <!-- Expand button -->
                                        <span v-if="index===0"
                                              @click="expandedRow=expandedRow===rowNum ? false : rowNum">
                                            <ExpandIcon v-if="expandedRow!==rowNum"
                                                        class="w-6 fill-[#ccc] cursor-pointer"/>
                                            <CollapseIcon v-else class="w-6 fill-[#ccc] cursor-pointer"/>
                                        </span>
                                        <!-- Row Name -->
                                        <span v-if="index===0" :class="index ? '' : 'w-full'" class="leading-5">
                                            <input @click.prevent
                                                   class="w-full underline decoration-dashed underline-offset-4"
                                                   v-model="modelValue.tabs[tabId].table.rows[rowNum].row[index]"
                                            />
                                        </span>
                                        <!-- Price -->
                                        <div v-else class="flex" :class="index ? '' : 'border-b border-dashed border-black'">
                                            <input class="w-full underline decoration-dashed underline-offset-4"
                                                   v-model="modelValue.tabs[tabId].table.rows[rowNum].row[index]"
                                            />
                                        </div>
                                        <!-- Delete row -->
                                        <div v-if="index===2" @click='modelValue.tabs[tabId].table.rows.splice(rowNum, 1)'
                                             class="text-sm font-bold py-0 w-5 border rounded text-center bg-red-500 text-white cursor-pointer"
                                        >×</div>
                                    </div>
                                </div>
                                <!-- Expanded -->
                                <div v-if="expandedRow===rowNum" class="columns-2 px-10 py-4 text-sm">
                                    <div v-for="(item, index) in value.expand" class="relative mb-2 break-inside-avoid">
                                        <input class="w-full text-sm"
                                               v-model="modelValue.tabs[tabId].table.rows[rowNum].expand[index].title"
                                        />
                                        <textarea class="w-full text-sm text-gray-600 h-16"
                                                  v-model="modelValue.tabs[tabId].table.rows[rowNum].expand[index].text"
                                        />
                                        <div @click='modelValue.tabs[tabId].table.rows[rowNum].expand.splice(index, 1)'
                                             class="absolute top-0 right-0 text-sm font-bold py-0 w-5 border rounded text-center bg-red-500 text-white cursor-pointer"
                                        >×</div>
                                    </div>
                                    <!-- Add expand item -->
                                    <div @click='modelValue.tabs[tabId].table.rows[rowNum].expand.push({"text": "", "title": ""})'
                                         class="mt-6 text-sm font-bold py-0 w-5 border rounded text-center bg-gray-500 text-white cursor-pointer"
                                    >+</div>
                                </div>
                            </div>
                            <!-- Add row -->
                            <div @click='modelValue.tabs[tabId].table.rows.push({"row": ["", 0, 0], "expand": [{"text": "", "title": ""}]})'
                                 class="mt-6 text-xl font-bold py-0 w-7 border rounded text-center bg-yellow-400 text-white cursor-pointer"
                            >+</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.calculator-edit input,
.calculator-edit textarea,
.calculator-edit select {
    border-color: #eee;
    padding: 0;
}
</style>
