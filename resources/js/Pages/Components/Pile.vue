<script setup>
import {ref} from "vue";
import SwiperSlider from "@/Pages/Components/Sliders/SwiperSlider.vue";
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";
import BlankLinkIcon from "@/Svg/BlankLinkIcon.vue";


let props = defineProps({datum: Object, galleries:Object});
let activeGallery = ref(0);

let getObjectPageLink = () => {
    let res;

    res = props.datum?.links?.filter(function (link) {
        return link.gallerySlug === props.galleries[activeGallery.value].slug;
    })

    return (res ?? [])[0]?.href;
};
</script>
<template>
    <div class="block-container">
        <!-- Html before slider -->
        <div v-if="datum?.pre" class="w-full mobile-px" v-html="datum?.pre"></div>

        <!-- Pile block -->
        <div class="lg:-mx-16 flex flex-col md:flex-row md:h-[380px] lg:h-[500px] gap-8">
            <!-- Main Gallery Slider -->
            <div class="relative w-full sm:min-w-[480px] lg:w-[720px] h-full">
                <Link v-if="getObjectPageLink()"
                      class="absolute top-1 right-1 z-10 rounded bg-[#1071ff] !text-white p-2 w-10 h-10"
                      :href="getObjectPageLink()"
                >
                    <BlankLinkIcon/>
                </Link>

                <SwiperSlider :gallery="galleries[activeGallery]" :datum='datum' :pagination="datum?.prev === false" disableCaption="true"/>
            </div>

            <!-- Wide gallery selector -->
            <div class="hidden md:flex">
                <div v-if="datum?.prev !== false" class="flex flex-col space-y-3 overflow-y-auto">
                    <div @click="activeGallery=index"
                         v-for="(gallery,index) in galleries"
                         :key="gallery.id"
                         class="flex space-x-4 group cursor-pointer">
                        <div class="max-w-[200px] h-fit bg-[#313334]">
                            <!-- TODO сравнять размер блока превью с размером файла -->
                            <LazyImg class="group-hover:opacity-70 transition-all duration-500 "
                                 :alt="gallery?.images[0]?.name"
                                 :class="{'!opacity-40':activeGallery===index}"
                                 :src="'/storage/galleries/' + gallery.slug + '/195x130/' + gallery?.images[0]?.name + '.webp'" />
                        </div>
                        <div class="w-[180px]">{{gallery.title}}</div>
                    </div>
                </div>
                <div v-else class="min-w-[250px] flex flex-col space-y-3 overflow-y-auto">
                    <div>
                        <h3 class="my-2 text-2xl">{{ datum?.title }}</h3>
                    </div>
                    <div @click="activeGallery=id" v-for="(gallery,id) in galleries"
                         class="flex space-x-4 group cursor-pointer">
                        <div class="text-[#909597] hover:underline underline-offset-4 decoration-dashed"
                             :class="{ 'text-black' : activeGallery===id }"

                        >- {{ gallery.title }}</div>
                    </div>
                </div>
            </div>

            <!-- Mobile gallery selector -->
            <div v-if="datum?.prev !== false" class="max-h-56 overflow-y-auto block md:hidden w-full bg-repeat bg-contain"
                 :style="'background-image: url(/storage/galleries/' + galleries[activeGallery]?.slug + '/webp/' + galleries[activeGallery]?.images[0].name +'.webp); scrollbar-width: none;'"
            >
                <div @click="activeGallery=id" v-for="(gallery,id) in galleries"
                     class="py-2 px-2 bg-[rgba(45,52,62,0.72)] text-white text-[15px]"
                     :class="activeGallery===id ? '!bg-[rgba(17,101,226,0.82)]' : 'cursor-pointer'"
                >
                    {{ gallery.title }}
                </div>
            </div>
        </div>

        <!-- Html after slider -->
        <div v-if="datum?.ps" class="w-full mobile-px" v-html="datum?.ps"></div>
    </div>
</template>
