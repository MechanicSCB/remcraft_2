<script setup>
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";

let props = defineProps({modelValue:Object});
</script>
<template>
    <TipTap menu="fixed" class="main block-container mobile-px border min-h-[120px]" icon-size1="20" v-model="modelValue['body']"/>
</template>
