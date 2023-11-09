<script setup>
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";
import MosaicSlider from "@/Pages/Components/Sliders/MosaicSlider.vue";
import QuatroSlider from "@/Pages/Components/Sliders/QuatroSlider.vue";

let props = defineProps({datum: Object, galleries:Object});
</script>
<template>
    <div class="flex flex-col">
        <!-- Html before slider -->
        <div class="w-full block-container mobile-px" v-if="datum?.pre" v-html="datum?.pre"></div>

        <!-- Slider -->
        <div class="w-full">
            <MosaicSlider class="block-container" v-if="datum?.type === 'mosaic'" :gallery='galleries[0]'/>
            <QuatroSlider class="block-container" v-else-if="datum?.type === 'quatro'" :gallery='galleries[0]'/>
            <SwiperSlider v-else :gallery='galleries[0]' :datum="datum"/>
        </div>

        <!-- Html after slider -->
        <div class="w-full block-container mobile-px" v-if="datum?.ps" v-html="datum?.ps"></div>
    </div>
</template>
