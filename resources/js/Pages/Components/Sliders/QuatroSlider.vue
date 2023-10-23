<script setup>
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";

let props = defineProps({gallery: Object});

// TODO replace to common?
function getImagePath(image, format = '720x480') {
    let path = '/storage/galleries/' + props.gallery.slug + '/' + format + '/' + image.name + '.';

    if (format === 'orig') {
        path += image.ext;
    } else {
        path += 'webp';
    }

    return path;
}
</script>
<template>
    <div>
        <!-- Wide Screen > 1024px -->
        <div class="grid sm:grid-cols-2 gap-10">
            <div v-for="(image, imgIndex) in gallery?.images" :key="image.id">
                <LazyImg class="mx-auto max-w-[480px]" :src="getImagePath(image, '480x320')" alt=""/>
            </div>
        </div>
    </div>
</template>
