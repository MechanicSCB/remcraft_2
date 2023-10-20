<script setup>
import {ref} from "vue";
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";

let props = defineProps({modelValue:Object});
let emits = defineEmits(['update:modelValue']);
let showRawHtml = ref(false);

emits('update:modelValue', ref({
    'body': props.modelValue?.body ?? '',
}));
</script>
<template>
    <div>
        <div>
            <div class="btn mb-2 text-sm cursor-pointer" v-if="showRawHtml" @click="showRawHtml=false">включить редактор</div>
            <div class="btn mb-2 text-sm cursor-pointer" v-else @click="showRawHtml=true">показать код</div>
        </div>

        <textarea v-if="showRawHtml" class="min-h-[120px] w-full" v-model="modelValue['body']"></textarea>
        <TipTap menu="fixed" v-else class="main block-container mobile-px border min-h-[120px]" icon-size1="16" v-model="modelValue['body']"/>
    </div>
</template>
