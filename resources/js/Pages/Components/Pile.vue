<script setup>
import {ref} from "vue";
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";


defineProps({datum: Object, galleries:Object});
let activeGallery = ref(0);
</script>
<template>
    <div>
        <div class="lg:-mx-16 mt-6 flex flex-col md:flex-row md:h-[320px] lg:h-[480px] gap-8">
            <div class="w-full sm:min-w-[480px] lg:min-w-[720px] h-full">
                <SwiperSlider :images="galleries[activeGallery]?.images" disableCaption="true"/>
            </div>
            <!-- Wide gallery selector -->
            <div class="hidden md:flex flex-col space-y-3 overflow-y-auto">
                <div @click="activeGallery=id" v-for="(gallery,id) in galleries"
                     class="flex space-x-4 group cursor-pointer">
                    <div class="w-1/2 h-fit bg-[#313334]">
                        <img class="group-hover:opacity-70 transition-all duration-500"
                             :src="gallery.images[0]" :class="{'!opacity-40':activeGallery===id}"/>
                    </div>
                    <div class="w-1/2">{{gallery.title}}</div>
                </div>
            </div>

            <!-- Mobile gallery selector -->
            <div class="max-h-56 overflow-y-auto block md:hidden w-full bg-repeat bg-contain"
                 :style="'background-image: url('+ galleries[activeGallery]?.images[0] +'); scrollbar-width: none;'"
            >
                <div @click="activeGallery=id" v-for="(gallery,id) in galleries"
                     class="py-2 px-2 bg-[rgba(45,52,62,0.72)] text-white text-[15px]"
                     :class="activeGallery===id ? '!bg-[rgba(17,101,226,0.82)]' : 'cursor-pointer'"
                >
                    {{ gallery.title }}
                </div>
            </div>
        </div>
    </div>
</template>
