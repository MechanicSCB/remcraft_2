<script setup>
import Html from "@/Pages/Components/Html.vue";
import Gallery from "@/Pages/Components/Gallery.vue";
import Masonry from "@/Pages/Components/Masonry.vue";
import YoutubeChannel from "@/Pages/Components/YoutubeChannel.vue";

defineProps({page: Object, time:String})

const components = {
    'Html': Html,
    'Gallery': Gallery,
    'Masonry': Masonry,
    'YoutubeChannel': YoutubeChannel,
}
</script>

<template>
    <div>
        <!-- TODO DEV! -->
        <div class="absolute z-50">{{ page?.time }}</div>
        <div v-for="block in page['blocks']">
            <div :class="block.classes">
                <component :is="components[block['component'].type]"
                           :style="'padding:' + block.padding"
                           :class="block.inner_classes"
                           :datum="block['component'].datum"
                           :galleries="block['component'].galleries"
                />
            </div>
        </div>
    </div>
</template>
