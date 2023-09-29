<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {
            console.log('slide change');
        };
        return {
            onSwiper,
            onSlideChange,
        };
    },
};
</script>
<template>
    <swiper
        :slides-per-view="3"
        :space-between="1"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
    >
        <swiper-slide>
            <img src="/storage/images/001.jpg" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="/storage/images/002.jpg" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="/storage/images/003.jpg" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="/storage/images/004.jpg" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="/storage/images/005.jpg" alt="">
        </swiper-slide>
    </swiper>
</template>

