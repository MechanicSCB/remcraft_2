<script setup>
import Slider from "@/Blocks/Slider.vue";
import TinySlider from "@/Blocks/TinySlider.vue";
import SwiperSlider from "@/Blocks/SwiperSlider.vue";

defineProps({images:Object})
</script>
<template>
    <!--<Slider :images="images"/>-->
    <!--<TinySlider :images="images"/>-->
    <SwiperSlider :images="images"/>
</template>

