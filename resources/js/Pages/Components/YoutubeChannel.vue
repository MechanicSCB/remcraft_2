<script setup>
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";
import LazyIFrame from "@/Pages/Components/Partials/LazyIFrame.vue";

let props = defineProps({datum: Object, galleries: Object});

// https://youtube.com/embed/Vz_TApQvUpk?controls=0&autoplay=1&mute=1&playsinline=1&start=45&loop=1
// /video/video_2.webm
// https://vk.com/video_ext.php?oid=-47273267&id=456240082&hash=4b55ae2d18bb724e&autoplay=1&loop=1
</script>
<template>
    <div class="relative w-full h-[720px] text-white overflow-hidden">
        <video v-if="datum?.src.startsWith('/video')" autoplay muted loop class="absolute z-0 w-full h-full object-cover">
            <source :src="datum.src" type="video/webm" />
        </video>

        <div v-else class="flex justify-center items-center h-full">
            <!-- TODO hide adds and controls if vk -->
            <LazyIFrame class="absolute mx-auto z-0 w-[300%] h-full xl:h-[150%] bg-gray-950" :src="datum?.src"/>
        </div>

        <div class="z-1 absolute w-full h-full bg-[rgba(0,0,0,0.5)]"></div>

        <div class="top-24 left-0 right-0 z-2 absolute block-container px-2.5 lg:px-0">
            <div class="flex text-base lg:flex-row flex-col">
                <!-- Header -->
                <div class="w-2/3 mb-8">
                    <h2 class="uppercase leading-10">Канал на youtube</h2>
                    <p class="mt-10 w-2/3 mb-6">Канал на котором рассказываем о технологиях и принципах подхода к
                        комплексному ремонту. </p>
                    <a target="_blank" href="https://www.youtube.com/c/REMCRAFT%E2%80%8B/">Перейти на Youtube канал
                        компании</a>
                </div>

                <!--  Links  -->
                <div class="bg-[rgba(0,0,0,0.3)] px-5 py-5 grid grid-cols-1 md:max-lg:grid-cols-2 gap-4">
                    <a v-for="(item, id) in datum.items" :href="item.href" target="_blank"
                       class="flex space-x-3 hover:opacity-75">
                        <LazyImg class="w-[150px] h-[100px]" :src="'/storage/galleries/' + galleries[0]?.slug +'/195x130/' + galleries[0]?.images[id]?.name + '.webp'" alt=""/>
                        <div class="text-white text-sm h-24 overflow-hidden">
                            {{ item.text }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
