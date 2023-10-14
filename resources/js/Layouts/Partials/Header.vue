<script setup>
import Logo from "@/Svg/Logo.vue";
import {inject, onMounted, ref} from "vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";
import HamburgerButton from "@/Layouts/Partials/HamburgerButton.vue";

let isScrolled = inject('isScrolled')
let showMobileMenu = inject('showMobileMenu')

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
            <div v-for="item in $page.props.menu" class="hover:text-ui-link-hover group/main h-full flex px-4 items-center">
                <Link :href="item.href" class="hover:text-ui-link-hover">{{ item.title }}</Link>
                <!-- menu items background -->
                <div v-if="Object.keys(item.sub_items).length" class="hidden z-0 group-hover/main:block fixed w-full bg-[rgba(243,242,240,0.97)] left-0 h-32 transition-all duration-300" :class="isScrolled ? 'top-16' : 'top-24'"></div>

                <!-- Menu items positioning relative to the parent  -->
                <div v-if="Object.keys(item.sub_items).length" class="hidden z-50 group-hover/main:block fixed h-32 transition-all duration-300" :class="isScrolled ? 'top-16' : 'top-24'">
                    <div class="flex flex-col flex-wrap h-full py-4">
                        <div v-for="subItem in item.sub_items"
                             class="mb-2 mr-10 group/sub w-full text-[#909597]"
                        >
                            <div class="flex items-center">
                                <Link :href="subItem.href" class="hover:text-[#353535] hover:underline">{{ subItem.title }}</Link>
                                <div v-if="Object.keys(subItem.sub_items).length" class="ml-4 h-full">
                                    <CollapseIcon class="w-5 h-5 fill-indigo-500"/>
                                </div>
                            </div>
                            <div v-if="Object.keys(subItem.sub_items).length" class="absolute h-0 w-0">
                                <div class="hidden group-hover/sub:flex flex-col space-y-3 text-[18px] text-[#909597] bg-white relative left-[150px] top-[-30px] px-8 py-4 w-[350px] shadow-xl">
                                    <Link :href="subSubItem.href" v-for="subSubItem in subItem.sub_items" class="hover:text-black hover:underline transition-all duration-300">
                                        {{ subSubItem.title }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="flex space-x-4">
            <!-- Phone -->
            <div class="block md:hidden bg-[#1071ff] text-xs text-white px-6 py-3">
                <Link href="#" preserve-scroll>+7&nbsp;(985)&nbsp;740-30-30</Link>
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
                <Link href="#" preserve-scroll>+7&nbsp;(985)&nbsp;740-30-30</Link>
            </div>
            <Link :href="route('admin')" class="bg-[#1071ff] text-white px-6 py-3">Оставить&nbsp;заявку</Link>
        </div>
    </div>
</template>
