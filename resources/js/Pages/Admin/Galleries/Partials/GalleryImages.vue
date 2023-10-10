<script setup>
import {router} from "@inertiajs/vue3";
import GalleryImage from "@/Pages/Admin/Galleries/Partials/GalleryImage.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {ref} from "vue";

let props = defineProps({gallery: Object,});
let showModal = ref(null);

let imgFormat = ref('orig');

let getSrc = (image) => {
    let src = '/storage/galleries/' + props.gallery.slug + '/' + imgFormat.value + '/' + image.n + '.';

    if(imgFormat.value==='orig'){
        src+=image.e;
    }else {
        src+='webp';
    }

    return src;
};

let deleteImage = (imageId) => {
    router.delete(route('images.destroy', imageId));
};

// Drag and Drop Images
function dragStart(event, draggedImgId) {
    event.dataTransfer.setData("draggedImgId", draggedImgId); //event.dataTransfer.effectAllowed = 'move'; event.dataTransfer.setDragImage(ev.target,100,100); return true;
}

function dragEnter(event, el) {/* ev.preventDefault(); return true;*/}

function dragOver(event, el) {/* ev.preventDefault();*/}

function dragDrop(event, order) {
    router.post(route('images.reorder', [event.dataTransfer.getData("draggedImgId"), order]));
}
</script>
<template>
    <select v-model="imgFormat" class="py-0 rounded mb-1">
        <option>orig</option>
        <option v-for="format in $page.props.imgFormats">{{ format }}</option>
    </select>
    <div class="flex flex-wrap gap-3">
        <div v-for="image in gallery?.images" :key="image.id"
             class="relative border cursor-grab"
             @drop.prevent="dragDrop($event,image.o)"
             @dragstart="dragStart($event,image.id)"
             @dragenter.prevent="dragEnter($event, $el)"
             @dragover.prevent="dragOver($event, $el)"
             draggable="true"
        >
            <CloseCross @click="deleteImage(image.id)" class="w-6 absolute right-0 hover:text-red-600 cursor-pointer"/>
            <GalleryImage @click="showModal=getSrc(image)" :image="image" :src="getSrc(image)"/>
        </div>
    </div>

    <!--  Modal  -->
    <div @click="showModal=null" v-if="showModal" class="fixed top-0 left-0 w-full h-screen bg-[rgba(0,0,0,0.7)] flex items-center justify-center">
        <img :src="showModal" alt="">
    </div>
</template>
