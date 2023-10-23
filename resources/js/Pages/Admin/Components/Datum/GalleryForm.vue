<script setup>
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";

let props = defineProps({modelValue:Object});
</script>
<template>
    <select class="border-gray-200 rounded" v-model="modelValue['type']">
        <option value="">null</option>
        <option>mosaic</option>
        <option>swiper</option>
        <option>quatro</option>
    </select>

    <div class="mt-6 main">
        <div>Текст перед слайдером</div>
        <TipTap no-fix class="border min-h-[150px]" v-model="modelValue['pre']"/>

        <div class="mt-6">Текст после слайдера</div>
        <TipTap no-fix class="mt-4 border min-h-[150px]" v-model="modelValue['ps']"/>
    </div>
</template>
