<script setup>
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({modelValue: Object});
</script>
<template>
    <div class="mt-4">
        <LabelInput input-class="w-[550px]" v-model="modelValue.title" placeholder="введите заголовок"/>
        <LabelInput input-class="w-[550px]" v-model="modelValue.src" placeholder="введите ссылку на источник фрейма"/>
    </div>
</template>
