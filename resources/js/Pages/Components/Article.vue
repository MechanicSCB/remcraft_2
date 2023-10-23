<script setup>
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";

let props = defineProps({datum: Object, galleries: Object});
</script>
<template>
    <div class="block-container mobile-px">
        <h2 class="mb-3" v-if="datum.title">{{ datum.title }}</h2>
        <div class="mb-8" v-if="datum.pre" v-html="datum.pre"/>

        <!-- ITEMS -->
        <div class="">
            <div v-for="(item, id) in datum.items"
                 class="w-full mb-12"
            >
                <h3>{{ item.title }}</h3>

                <div>
                    <div v-if="item.pre" v-html="item.pre" class="mb-5"/>

                    <!-- Central div -->
                    <div class="mt-3 flex gap-10"
                         :class="(item.type ?? datum.type) === 'right_img' ? 'flex-col-reverse md:flex-row-reverse' : 'flex-col md:flex-row'"
                         :style="datum.designers ? 'background-color:#F3F2F0' : ''"
                    >
                        <div class="w-full sm:w-[480px] shrink-0" :class="{'max-w-[285px]': datum.designers}">
                            <LazyImg :src="'/storage/galleries/'+galleries[0]?.slug + '/webp/' +galleries[0]?.images[id]?.name +'.webp'"
                                 :title="item.title"
                                 :alt="item.title"
                            />
                        </div>
                        <div v-html="item.body"/>
                    </div>

                    <div v-if="item.ps" v-html="item.ps" class="mt-8"/>
                </div>
            </div>
        </div>
    </div>
</template>
