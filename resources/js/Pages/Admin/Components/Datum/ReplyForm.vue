<script setup>
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";

let props = defineProps({modelValue:Object});
</script>
<template>
    <LabelInput input-class="w-full" v-model="modelValue['title']">Заголовок</LabelInput>

    <TipTap class="main block-container mobile-px border min-h-[120px]"
            no-fix icon-size="20"
            v-model="modelValue['body']"
            placeholder="  описание"
    />
</template>
