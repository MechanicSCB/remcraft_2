<script setup>
let props = defineProps({datum: Object, galleries: Object});
</script>
<template>
    <div class="block-container">
        <!-- WIDE -->
        <div v-if="datum.type === 'wide'">
            <div class="px-10 w-full min-h-[240px] flex items-center bg-[-25rem] sm:bg-center bg-no-repeat bg-cover" :style="'background-image: url(/storage/galleries/' + galleries[0]?.slug + '/webp/' + galleries[0]?.images[0].name +'.webp);'">
                <h1 class="max-w-[800px]" v-html="datum?.text_1"></h1>
            </div>
            <div class="px-10 py-6 w-full bg-[#346ffd] text-white min-h-[240px] flex items-center">
                <div v-html="datum?.text_2"></div>
            </div>
        </div>

        <!-- SQUARE -->
        <div class="flex h-[500px]" v-else>
            <div class="px-10 py-12 w-full bg-[#346ffd] text-white min-h-[240px]"
                 v-html="datum?.text_1"
            />

            <div class="px-10 w-full min-h-[240px] flex items-center bg-[-25rem] bg-center bg-no-repeat bg-cover"
                 :style="'background-image: url(/storage/galleries/' + galleries[0]?.slug + '/webp/' + galleries[0]?.images[0]?.name +'.webp);'"
            />
        </div>
    </div>
</template>
