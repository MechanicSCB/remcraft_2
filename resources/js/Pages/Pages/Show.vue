<script setup>
import Html from "@/Pages/Components/Html.vue";
import Gallery from "@/Pages/Components/Gallery.vue";
import Masonry from "@/Pages/Components/Masonry.vue";
import YoutubeChannel from "@/Pages/Components/YoutubeChannel.vue";

defineProps({page: Object})

const components = {
    'Html': Html,
    'Gallery': Gallery,
    'Masonry': Masonry,
    'YoutubeChannel': YoutubeChannel,
}
</script>

<template>
    <div>
        <div v-for="block in page['blocks']">
            <div :class="block.classes">
                <component :style="'padding:' + block.padding" :is="components[block['component'].type]"
                           :class="block.inner_classes" :datum="block['component'].datum" :galleries="block['component'].galleries"/>
            </div>
        </div>
    </div>
</template>
