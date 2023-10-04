<script setup>
import { register } from 'swiper/element/bundle';

let props = defineProps({images:Object})
register();
</script>

<template>
    <swiper-container
        :rewind="true"
        :grabCursor="true"
        :slides-per-view="'auto'"
        :space-between="1"
        navigation="true"
        :pagination1="{ clickable: true }"
        :scrollbar="{ draggable: true }"
    >
        <swiper-slide class="max-w-[480px] md:max-w-[720px] overflow-hidden" v-for="(link, id) in images" lazy="true">
            <img :loading="id ? 'lazy' : 'eager'" alt="" class="hover:scale-[1.1] transition-all overflow-hidden duration-1000" :src="link" />
        </swiper-slide>
    </swiper-container>
</template>
