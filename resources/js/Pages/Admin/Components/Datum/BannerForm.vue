<script setup>
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({modelValue:Object});
</script>
<template>
    <select v-model="modelValue['type']">
        <option value="">null</option>
        <option>square</option>
        <option>wide</option>
    </select>
    <TipTap class="main block-container mobile-px border min-h-[120px]"
            no-fix icon-size="20"
            v-model="modelValue['text_1']"
            placeholder="введите текст первого блока"
    />
    <TipTap class="main block-container mobile-px border min-h-[120px]"
            no-fix icon-size="20"
            v-model="modelValue['text_2']"
            placeholder="введите текст второго блока"
    />
</template>
