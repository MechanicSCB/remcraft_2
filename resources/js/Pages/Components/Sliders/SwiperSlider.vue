<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules';


import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

let props = defineProps({gallery:Object});

function getImagesPaths(){
    let paths = [];

    for(let image of props.gallery?.images ?? []){
        paths.push('/storage/galleries/' + props.gallery.slug + '/720x480/' + image.name + '.webp');
    }

    return paths;
}

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
        :pagination="{ clickable: true }"
        :scrollbar="{ draggable: true }"
    >
        <swiper-slide  class="aspect-[3/2] max-w-[480px] sm:max-w-[720px] bg-gray-100" v-for="(src, id) in getImagesPaths()">
            <img :loading="id > -1 ? 'lazy' : 'eager'" :src="src" alt="">
        </swiper-slide>
    </swiper>
</template>
<style>
.swiper-button-prev,
.swiper-button-next{
    color: #333;
    background: rgba(255,255,255,0.3);
}

.swiper-button-prev:hover,
.swiper-button-next:hover{
    background: rgba(255,255,255,0.7);
}

.swiper-pagination-bullet{
    width: 30px;
    height: 4px;
    background: #fff !important;
    border-radius: 0;
    opacity: 1;
}

.swiper-pagination-bullet-active{
    background: #1071ff !important;
}

.swiper-pagination{
    margin-bottom: -30px;
    transition: all 300ms ease;
}

.swiper:hover .swiper-pagination{
    margin-bottom: 30px;
}

</style>
