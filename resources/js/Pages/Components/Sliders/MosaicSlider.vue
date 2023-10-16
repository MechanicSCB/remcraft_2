<script setup>
import {ref} from "vue";
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";

let props = defineProps({gallery: Object});
let showModalImg = ref(false)
let selectedImage = ref(0);

function getImagePath(image, format = '720x480') {
    let path = '/storage/galleries/' + props.gallery.slug + '/' + format + '/' + image.name + '.';

    if (format === 'orig') {
        path += image.ext;
    } else {
        path += 'webp';
    }

    return path;
}

function slideLeft() {
    if (selectedImage.value > 0) selectedImage.value--;
}

function slideRight() {
    if (selectedImage.value < props.gallery.images.length - 1) selectedImage.value++;
}
</script>
<template>
    <div>
        <!--    MODAL IMAGE    -->
        <div @click="showModalImg=!showModalImg" v-if="showModalImg"
             class="top-0 left-0 p-2 flex min-h-screen fixed overflow-auto bg-[rgba(0,0,0,0.8)] w-full h-full z-[80]"
        >
            <button v-if="selectedImage > 0" @click.stop="slideLeft"
                    class="fixed top-1/2 left-2 w-10 h-10 bg-black opacity-50 hover:opacity-75"
            >
                <svg class="mx-auto fill-white w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"></path>
                </svg>
            </button>

            <div class="max-h-screen w-full flex items-center">
                <img :src="getImagePath(gallery.images[selectedImage],'webp')" alt=""
                     class="mx-auto max-h-full max-w-full"
                >
            </div>

            <button v-show="selectedImage < gallery.images.length - 1" @click.stop="slideRight"
                    class="fixed top-1/2 right-2 w-10 h-10 bg-black opacity-50 hover:opacity-75"
            >
                <svg class="mx-auto fill-white w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"></path>
                </svg>
            </button>
        </div>

        <!-- Wide Screen > 1024px -->
        <div class="hidden lg:block mx-auto max-w-[720px] xl:max-w-none">
            <div v-for="(image, imgIndex) in gallery.images" :key="image.id"
                 class="relative float-left"
            >
                <LazyImg :src="getImagePath(image,imgIndex%3 === 0 ? '720x480' : '360x240')"
                         class=""
                         :class="imgIndex%3 === 0 ? 'w-[720px]' : 'w-[360px]'"
                         alt=""
                />
                <div @click="showModalImg = true; selectedImage = imgIndex"
                     class="top-0 absolute border border-4 border-white w-full h-full cursor-pointer"
                ></div>
            </div>
        </div>

        <!-- 640px < Laptop Screen < 1024px -->
        <div class="hidden sm:block lg:hidden mx-auto max-w-[720px] xl:max-w-none">
            <div v-for="(image, imgIndex) in gallery.images" :key="image.id"
                 class="relative w-full max-w-[720px] min-h-[240px]"
            >
                <LazyImg :src="getImagePath(image,'720x480')"
                         class="w-[720px]"
                         alt=""
                />
                <div @click="showModalImg = true; selectedImage = imgIndex"
                     class="top-0 absolute border border-4 border-white w-full h-full cursor-pointer"
                ></div>
            </div>
        </div>

        <!-- Mobile Screen < 640px -->
        <div class="block sm:hidden mx-auto max-w-[480px] xl:max-w-none">
            <div v-for="(image, imgIndex) in gallery.images" :key="image.id"
                 class="relative w-full max-w-[480px] min-h-[150px]"
            >
                <LazyImg :src="getImagePath(image,'480x320')"
                         class="w-[480px]"
                         alt=""
                />
                <div @click="showModalImg = true; selectedImage = imgIndex"
                     class="top-0 absolute border border-4 border-white w-full h-full cursor-pointer"
                ></div>
            </div>
        </div>
    </div>
</template>
