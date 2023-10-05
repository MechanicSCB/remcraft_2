<script setup>
import {inject} from "vue";

let props = defineProps({tabName: String});

let activeTab = inject('activeTab');
</script>

<template>
    <div @click="activeTab=tabName"
        class="w-44 text-center py-1 border hover:bg-[#1071ff] hover:text-white transition-all duration-500"
        :class="activeTab===tabName?'bg-[#1071ff] text-white':' cursor-pointer'"
    >
        <slot/>
    </div>
</template>

<style scoped>

</style>
