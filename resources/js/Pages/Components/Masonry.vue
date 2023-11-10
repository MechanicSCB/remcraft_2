<script setup>
let props = defineProps({datum: Object});
</script>
<template>
    <div class="block-container mobile-px">
        <h2 v-if="datum?.title" class="mb-8">{{ datum?.title }}</h2>
        <div class="lg:-ml-16 xl:columns-2 gap-x-20 space-y-4">
            <div v-for="brick in datum?.bricks" class="py-10 px-3 lg:px-16 break-inside-avoid"
                 :class="{'corner':brick.corner}"
            >
                <div class="flex items-center space-x-6">
                    <img v-if="brick.icon" class="lg:-ml-16"
                         :src="'/storage/images/masonry-icons/' + brick.icon + '.svg'" :alt="brick.icon">
                    <h3 class="text-2xl">{{ brick.title }}</h3>
                </div>
                <div class="mt-4" v-html="brick.body"/>
                <div class="mt-5 text-sm">
                    <Link v-for="link in brick.links" :href="link.href" class="mr-2 underline hover:no-underline">{{ link.text }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.corner {
    background: url(/storage/images/masonry-icons/corner.png) 100% 0 no-repeat #f3f2f0;
}
</style>
