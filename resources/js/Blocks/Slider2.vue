<script setup>
import { register } from 'swiper/element/bundle';

let props = defineProps({images:Object})
register();
</script>

<template>
    <swiper-container
        :rewind="true"
        :grabCursor="true"
        :slides-per-view="1"
        :breakpoints="{
                              1600: {
                                slidesPerView: 3,
                              },
                              1400: {
                                slidesPerView: 2.5,
                              },
                              1200: {
                                slidesPerView: 2.0,
                              },
                              900: {
                                slidesPerView: 1.7,
                              },
                              700: {
                                slidesPerView: 1.3,
                              },
                            }"
        :space-between="1"
        navigation="true"
        :pagination1="{ clickable: true }"
        :scrollbar="{ draggable: true }"
    >
        <swiper-slide class="overflow-hidden" v-for="link in images" lazy="true">
            <img loading="lazy" alt="" class="w-full hover:scale-[1.1] transition-all overflow-hidden duration-1000" :src="link" />
        </swiper-slide>
    </swiper-container>
</template>
