<script setup>
import LazyIFrame from "@/Pages/Components/Partials/LazyIFrame.vue";

let props = defineProps({datum: Object, galleries: Object});

let getSrc = () => {
    if(props.datum.src.includes('watch?v=')){
        return 'https://www.youtube.com/embed/' + props.datum.src.split("watch?v=").pop();
    }else if(props.datum.src.includes('youtu')){
        return 'https://www.youtube.com/embed/' + props.datum.src.split("/").pop();
    }else{
        return props.datum.src;
    }
};
</script>
<template>
    <div class="block-container mobile-px">
        <h2 v-if="datum.title" class="mb-16">{{ datum.title }}</h2>
        <LazyIFrame class="mx-auto w-full h-[240px] sm:h-[360px] md:h-[420px] lg:h-[500px] xl:h-[600px]" :src="getSrc()"/>
    </div>
</template>
