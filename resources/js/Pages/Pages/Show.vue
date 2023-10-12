<script setup>
import {onMounted} from "vue";
import axios from "axios";
import BlockShow from "@/Pages/Pages/Partials/BlockShow.vue";

let props = defineProps({page: Object})

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

        <BlockShow v-for="block in page['blocks']" :block="block"/>
    </div>
</template>
