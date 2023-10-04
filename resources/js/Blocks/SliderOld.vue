<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import LazyImg from "@/Blocks/LazyImg.vue";

defineProps({images:Object});
</script>
<template>
    <swiper
        :slides-per-view="2.5"
        :space-between="1"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
    >
        <swiper-slide v-for="(src) in images.webp">
            <LazyImg loading="lazy" :src="src"/>
        </swiper-slide>
    </swiper>
</template>

