<script setup>
import {inject, onMounted, ref} from "vue";
import ExpandIcon from "@/Svg/ExpandIcon.vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";
import {ordered} from "@/Stores/Common.js";

let isScrolled = inject('isScrolled');
let showMobileMenu = inject('showMobileMenu')
let expandedItem = ref(null);
let expandedSubItem = ref(null);
</script>

<template>
    <div class="fixed z-50  w-full text-[#909597] bg-[#fbfafa] transition-all duration-300 overflow-y-auto max-h-screen"
         :class="isScrolled ? 'top-16' : 'top-24'"
    >
        <div v-for="(item, itemKey) in ordered($page.props.menu[1].nodes)" class=" flex flex-col">
            <!-- Main Items -->
            <Link class="px-10 border-t flex justify-between items-center hover:text-black"
                  :class="expandedItem===itemKey ? 'bg-[#1071ff] !text-white' : ''"
                  :href="item.href ?? item.slug ?? ''"
                  @click="showMobileMenu=false"
            >
                <div class="py-4">{{ item.title }}</div>
                <ExpandIcon v-if="Object.keys(item.nodes ?? {}).length && expandedItem!==itemKey" @click.prevent.stop="expandedItem=itemKey" class="pt-1 w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
                <CollapseIcon v-if="Object.keys(item.nodes ?? {}).length && expandedItem===itemKey" @click.prevent.stop="expandedItem=null" class="w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
            </Link>

            <!-- Expanded SubItems -->
            <div v-if="expandedItem===itemKey"
                 v-for="(subItem, subItemKey) in ordered(item.nodes)"
                 class="border-t bg-[rgba(232,232,232,0.54)] flex flex-col"
            >
                <div class="ml-20 flex items-center mr-10">
                    <Link @click="showMobileMenu=false" class="w-full h-full py-4" :href="subItem.href ?? subItem.slug ?? ''">{{ subItem.title }}</Link>
                    <ExpandIcon v-if="Object.keys(subItem.nodes ?? {}).length && expandedSubItem!==subItemKey" @click="expandedSubItem=subItemKey" class="pt-1 w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
                    <CollapseIcon v-if="Object.keys(subItem.nodes ?? {}).length && expandedSubItem===subItemKey" @click="expandedSubItem=null" class="w-7 h-7 bg-[#d8d8d8] rounded-full cursor-pointer"/>
                </div>

                <!-- Expanded SubSubItems -->
                <div v-if="expandedSubItem===subItemKey" v-for="(subSubItem, subSubItemKey) in ordered(subItem.nodes)" class="pl-20 border-t flex justify-between items-center pr-10 bg-[rgba(232,232,232,0.54)]">
                    <Link @click="showMobileMenu=false" class="ml-10 w-full h-full py-4" :href="subSubItem.href ?? subSubItem.slug  ?? ''">{{ subSubItem.title }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>
