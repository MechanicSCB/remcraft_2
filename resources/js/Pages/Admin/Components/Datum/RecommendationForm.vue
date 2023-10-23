<script setup>
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({modelValue:Object});
</script>
<template>
    <LabelInput v-model="modelValue['title']">Заголовок</LabelInput>

    <div class="mt-4">
        <!-- Items -->
        <div class="mt-5 text-sm flex flex-col gap-1">
            <div v-for="(item, itemId) in modelValue.items" class="flex items-center gap-2">
                <input v-model="modelValue.items[itemId].text"
                       class="text-sm w-[450px]"
                       placeholder="введите текст ссылки"
                       required/>
                <input v-model="modelValue.items[itemId].href"
                       class="text-sm w-[650px]"
                       placeholder="введите url ссылки"
                       required/>
                <div @click="modelValue.items.splice(itemId, 1)"
                     class="px-1.5 pb-0.5 font-bold bg-red-600 text-white rounded-full cursor-pointer">
                    ×
                </div>
            </div>
            <div @click="(modelValue.items ??= []).push({'text':'', 'href':''})"
                 class="my-2 btn w-fit"
            >
                добавить элемент
            </div>
        </div>
    </div>
</template>
