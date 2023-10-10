<script setup>
import {ref} from "vue";

let props = defineProps({gallery: Object});
let showModalImg = ref(false)
let selectedImage = ref(0);

function getImagePath(image, format = 'w720') {
    // if(image.n === '001') format='w720'
    let path = '/storage/galleries/' + props.gallery.slug + '/' + format + '/' + image.n + '.';

    if (format === 'orig') {
        path += image.e;
    } else {
        path += 'webp';
    }

    return path;
}
</script>

<template>
    <div>
        <!--    MODAL IMAGE    -->
        <div @click="showModalImg=!showModalImg" v-if="showModalImg"
             class="top-0 left-0 p-2 flex min-h-screen fixed overflow-auto bg-[rgba(0,0,0,0.8)] w-full h-full z-[80]"
        >
            <div class="max-h-screen w-full flex items-center">
                <img :src="getImagePath(gallery.images[selectedImage],'orig')" alt=""
                     class="mx-auto h-full"
                >
            </div>
        </div>

        <div class="grid grid-cols-3">
            <div v-for="(image, imgIndex) in gallery.images" :key="image.id"
                 :class="{'col-span-2 row-span-2': imgIndex%3===0}"
                 class="relative"
            >
                <img :src="getImagePath(image,imgIndex%3===0 ? 'w720' :'w360')"
                     class=""
                     alt=""
                >
                <div @click="showModalImg = true; selectedImage = imgIndex"
                     class="top-0 absolute border border-4 border-white w-full h-full cursor-pointer"
                ></div>
            </div>
        </div>
    </div>
</template>
