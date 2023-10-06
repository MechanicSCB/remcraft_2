<script setup>
import Html from "@/Pages/Components/Html.vue";
import Gallery from "@/Pages/Components/Gallery.vue";
import Masonry from "@/Pages/Components/Masonry.vue";
import YoutubeChannel from "@/Pages/Components/YoutubeChannel.vue";
import {onMounted} from "vue";
import axios from "axios";
import Pile from "@/Pages/Components/Pile.vue";
import Cost from "@/Pages/Components/Cost.vue";
import Calculator from "@/Pages/Components/Calculator/Calculator.vue";
import Recommendation from "@/Pages/Components/Recommendation.vue";

let props = defineProps({page: Object, time: String})

const components = {
    'Html': Html,
    'Gallery': Gallery,
    'Masonry': Masonry,
    'YoutubeChannel': YoutubeChannel,
    'Pile': Pile,
    'Cost': Cost,
    'Calculator': Calculator,
    'Recommendation': Recommendation,
}

onMounted(() => {
    window.onscroll = () => {
        const len = props.page.blocks.length;

        // Stop loading when all blocks are loaded
        if (len >= props.page.len) return;

        let scrollHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight,
        );

        // TODO prevent repeated requests
        let bottomOfWindow = window.scrollY + window.innerHeight >= scrollHeight - 350;

        if (bottomOfWindow) {
            axios.get('/get-blocks/' + props.page.slug + '?from=' + len).then(response => {
                response.data.forEach((block, id) => {
                    if (props.page.blocks.length  === len + id) {
                        props.page.blocks.push(block);
                    }
                });
            });
        }
    }
});
</script>

<template>
    <div>
        <Head :title="page['title']">
            <meta typeof="description" :content="page['title']">
        </Head>
        <!-- TODO DEV! -->
        <div class="absolute z-50">{{ page?.time }}</div>
        <div v-for="block in page['blocks']">
            <div :class="block.classes" class="overflow-hidden">
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
