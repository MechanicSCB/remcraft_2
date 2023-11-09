<script setup>
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import CloseCross from "@/Svg/CloseCross.vue";
import GalleryImages from "@/Pages/Admin/Galleries/Partials/GalleryImages.vue";
import UploadImages from "@/Pages/Admin/Galleries/Partials/UploadImages.vue";
import GalleryForm from "@/Pages/Admin/Galleries/Partials/GalleryForm.vue";

let props = defineProps({gallery: Object});
let showModal = ref(false);
</script>
<template>
    <div>
        <div @click="showModal=true" class="cursor-pointer"><slot/></div>

        <div v-if="showModal" @click="showModal=false"
             class="fixed z-10 left-0 top-0 w-full h-screen py-2 px-8 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-full h-full bg-white rounded border p-5 cursor-default overflow-y-auto">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <!-- Show gallery's images -->
                <GalleryImages :gallery="gallery"/>

                <!-- Upload Photos -->
                <UploadImages class="my-4" v-if="gallery" :gallery="gallery"/>

                <!-- Gallery form ('title', 'slug', 'component_id', ...) -->
                <GalleryForm :gallery="gallery"/>
            </div>
        </div>
    </div>
</template>
