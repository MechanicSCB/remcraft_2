<script setup>
let props = defineProps({datum: Object});

</script>
<template>
    <div>
        <h2 class="text-4xl mb-6">{{ datum.title }}</h2>
        <p v-html="datum.description"></p>

        <!-- ITEMS -->
        <div class="mt-7 grid md:grid-cols-2 gap-10">
            <div v-for="(item, id) in datum.items"
                 @click="expand()"
                 class="aspect-square sm:aspect-[3/2] min-h-[240px] md:aspect-square bg-cover bg-center group flex flex-col justify-end"
                 :style="'background-image: url(/storage/images/cost/1/'+id+'.jpg)'"
            >
                <div
                    class="bg-[rgba(255,255,255,0.78)] w-full h-28 md:group-hover:h-full overflow-hidden px-6 py-10 transition-all duration-500">
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
