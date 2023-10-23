<script setup>
import MosaicSlider from "@/Pages/Components/Sliders/MosaicSlider.vue";
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";

let props = defineProps({datum: Object, galleries: Object});

</script>
<template>
    <div class="block-container mobile-px">
        <h2 v-if="datum.title" class="text-4xl mb-6">{{ datum.title }}</h2>

        <SwiperSlider :gallery="galleries[0]"/>

        <div class="mt-12 w-full flex gap-6">
            <img :src="'/storage/galleries/' + galleries[1]?.slug + '/webp/' + galleries[1]?.images[0].name + '.webp'" alt=""
                class="w-[350px] h-[350px]"
            >
            <p v-if="datum.body" v-html="datum.body"></p>
        </div>
    </div>
</template>
