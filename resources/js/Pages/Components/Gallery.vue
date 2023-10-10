<script setup>
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";
import MosaicSlider from "@/Pages/Components/Sliders/MosaicSlider.vue";

let props = defineProps({datum: Object, galleries:Object});

</script>
<template>
    <div>
        <MosaicSlider v-if="datum?.type === 'mosaic'" :gallery='galleries[0]'/>
        <SwiperSlider v-else :gallery='galleries[0]'/>
    </div>
</template>
