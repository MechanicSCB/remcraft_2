<script setup>
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";

let props = defineProps({modelValue:Object});
</script>
<template>
    <LabelInput input-class="w-full" v-model="modelValue['title']">Заголовок</LabelInput>

    <TipTap class="main block-container mobile-px border min-h-[120px]"
            no-fix icon-size="20"
            v-model="modelValue['description']"
            placeholder="  описание"
    />

    <div class="mt-4">
        <!-- Items -->
        <div class="mt-5 text-sm flex flex-col gap-6">
            <div v-for="(item, itemId) in modelValue.items" class="items-center border-t pt-2">
                <div class="flex flex-col">
                    <LabelInput input-class="w-[300px]" v-model="modelValue.items[itemId].name" placeholder="введите заголовок элемента"/>
                    <LabelInput v-model="modelValue.items[itemId].price" placeholder="введите стоимость"/>
                    <LabelInput v-model="modelValue.items[itemId].measure" placeholder="введите единицу измерения"/>
                </div>
                <TipTap class="main block-container mobile-px border min-h-[120px]"
                        no-fix icon-size="20"
                        v-model="modelValue.items[itemId].expand"
                        placeholder="введите текст спойлера"
                />
                <div @click="modelValue.items.splice(itemId, 1)"
                     class="w-fit px-1.5 pb-0.5 font-bold bg-red-600 text-white rounded-full cursor-pointer">
                    ×
                </div>
            </div>
            <div @click="(modelValue.items ??= []).push({'name':'', 'price':'', 'measure':'', 'expand':''})"
                 class="my-2 btn w-fit"
            >
                добавить элемент
            </div>
        </div>
    </div>
</template>
