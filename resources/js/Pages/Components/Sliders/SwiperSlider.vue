<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules';


import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

defineProps({images:Object});

let modules = [Navigation, Pagination, Scrollbar, A11y];

const onSwiper = (swiper) => {
    // console.log(swiper);
};
const onSlideChange = () => {
    // console.log('slide change');
};
</script>

<template>
    <swiper
        style="padding-bottom: 30px"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
        :rewind="true"
        :grabCursor="true"
        :slides-per-view="'auto'"
        :space-between="1"
        :modules="modules"
        navigation
        :scrollbar="{ draggable: true }"
    >
        <swiper-slide  class="max-w-[480px] sm:max-w-[720px]" v-for="(src, id) in images">
            <img :loading="id ? 'lazy' : 'eager'" :src="src" alt="">
        </swiper-slide>
    </swiper>
</template>
<style>
.swiper-button-prev,
.swiper-button-next{
    color: #333;
    background: rgba(255,255,255,0.3);
}
</style>
