<script setup>
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";

let props = defineProps({datum: Object, galleries:Object});

</script>
<template>
    <div>
        <SwiperSlider :gallery='galleries[0]'/>
    </div>
</template>
