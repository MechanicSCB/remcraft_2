<script setup>
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";

defineProps({datum: Object, galleries: Object});

let expand = (id) => {
    window['costItem' + id].classList.toggle("h-full");
};
</script>
<template>
    <div class="block-container mobile-px">
        <h2 v-if="datum.title" class="text-4xl mb-6">{{ datum.title }}</h2>
        <p v-if="datum.description" v-html="datum.description"></p>

        <!-- ITEMS -->
        <div class="mt-7 grid md:grid-cols-2 gap-10">
            <div v-for="(item, id) in datum.items"
                 class="relative h-[480px] group flex flex-col justify-end"
            >
                <div class="absolute left-0 top-0 h-full">
                    <LazyImg :src="'/storage/galleries/'+galleries[0]?.slug + '/720x480/' +galleries[0]?.images[id]?.name +'.webp'"
                         alt=""
                         class="h-full object-cover"
                    />
                </div>
                <div @click.stop="expand(id)"
                     :id="'costItem'+id"
                     class="relative bg-[rgba(255,255,255,0.78)] w-full h-28 md:group-hover:h-full overflow-hidden px-6 py-10 transition-all duration-500 cursor-pointer">
                    <div class="text-lg font-semibold">{{ item.name }}</div>
                    <div>
                        <span class="text-2xl font-bold">{{ item.price }}</span>
                        <span class="ml-1.5 text-lg font-bold">{{ item.measure }}</span>
                    </div>

                    <!-- expand -->
                    <div class="mt-4 expand text-base md:max-lg:text-sm" v-html="item.expand"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.expand > div {
    margin-bottom: 8px;
}
</style>
