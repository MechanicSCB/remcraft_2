<script setup>
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";

defineProps({datum: Object, galleries:Object});
</script>
<template>
    <div>
        <SwiperSlider :images="galleries[0].images"/>
    </div>
</template>
