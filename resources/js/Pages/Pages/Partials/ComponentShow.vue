<script setup>
import Html from "@/Pages/Components/Html.vue";
import Gallery from "@/Pages/Components/Gallery.vue";
import Masonry from "@/Pages/Components/Masonry.vue";
import YoutubeChannel from "@/Pages/Components/YoutubeChannel.vue";
import Pile from "@/Pages/Components/Pile.vue";
import Cost from "@/Pages/Components/Cost.vue";
import Calculator from "@/Pages/Components/Calculator/Calculator.vue";
import Recommendation from "@/Pages/Components/Recommendation.vue";
import Banner from "@/Pages/Components/Banner.vue";
import Article from "@/Pages/Components/Article.vue";
import IFrame from "@/Pages/Components/IFrame.vue";
import Bid from "@/Pages/Components/Bid.vue";
import Reply from "@/Pages/Components/Reply.vue";

defineProps({component: Object});

const components = {
    'Html': Html,
    'Gallery': Gallery,
    'Masonry': Masonry,
    'YoutubeChannel': YoutubeChannel,
    'Pile': Pile,
    'Cost': Cost,
    'Calculator': Calculator,
    'Recommendation': Recommendation,
    'Banner': Banner,
    'Article': Article,
    'IFrame': IFrame,
    'Reply': Reply,
    'Bid': Bid,
}
</script>
<template>
    <div>
        <component :is="components[component.type]"
                   :datum="component.datum"
                   :galleries="component.galleries"
        />
    </div>
</template>
