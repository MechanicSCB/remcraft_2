<script setup>
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import BidForm from "@/Pages/Components/Partials/BidForm.vue";

let props = defineProps({datum: Object});
let showModal = ref(false);
</script>
<template>
    <div class="block-container mobile-px">
        <div v-if="datum?.modal===false" class="bg-[#f3f2f0] px-4 md:px-10 xl:px-20 py-8">
            <h2>Заявка на расчет стоимости ремонта</h2>

            <BidForm/>
        </div>
        <div v-else>
            <!-- Modal show button -->
            <div class="mx-auto bg-blue-500 text-white w-fit h-fit px-6 py-3 cursor-pointer"
                 @click="showModal=true"
                 v-html="datum?.slot ?? 'Оставить&nbsp;заявку'"
            />

            <!-- Modal block -->
            <div v-if="showModal" @click="showModal=false"
                 class="fixed z-50 left-0 top-0 w-full h-screen py-20 px-4 bg-[rgba(0,0,0,0.7)] flex items-center cursor-pointer"
            >
                <div @click.stop class="relative block-container w-full h-fit max-h-screen mobile-px bg-white border py-20 !px-10 cursor-default overflow-y-auto">
                    <!-- Close Modal List Button -->
                    <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                    <BidForm/>
                </div>
            </div>
        </div>
    </div>
</template>
