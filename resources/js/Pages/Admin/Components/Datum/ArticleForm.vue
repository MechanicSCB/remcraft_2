<script setup>
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import TipTap from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTap.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {router} from "@inertiajs/vue3";
import {ref} from "vue";

let props = defineProps({modelValue:Object});

props.modelValue.type ??= ref('');

let deleteItem = (itemId) => {
    if (confirm('Вы действительно хотите удалить элемент?')) {
        props.modelValue.items.splice(itemId, 1);
    }
}
</script>
<template>
    <div class="mt-4">
        <div>
            <label for="img_align">положение фото всех элементов</label>

            <select class="ml-4 py-0.5 rounded h-fit border-gray-200 mb-4" id="img_align" v-model="modelValue.type">
                <option value="">не задано</option>
                <option value="left_img">фото слева</option>
                <option value="right_img">фото справа</option>
            </select>
        </div>

        <LabelInput input-class="w-[550px] text-4xl" v-model="modelValue.title" name="articleTitle">Заголовок всего блока</LabelInput>

        <hr class="my-4">
        <TipTap class="main block-container mobile-px border min-h-[120px]"
                icon-size="20"
                v-model="modelValue.pre"
                placeholder="   введите текст предшествующий всем блокам"
        />

        <!-- Items -->
        <div class="mt-5 main block-container mobile-px text-sm flex flex-col gap-6">
            <div v-for="(item, itemId) in modelValue.items" class="relative border-t-4 border-blue-600 pt-8">
                <LabelInput input-class="w-[550px] text-xl" v-model="modelValue.items[itemId].title" placeholder="введите заголовок элемента">заголовок элемента</LabelInput>

                <TipTap class="border min-h-[80px]"
                        no-fix
                        icon-size="20"
                        v-model="modelValue.items[itemId].pre"
                        placeholder="   введите надблоковый текст'"
                />

                <div class="my-6 flex gap-2"
                     :class="(modelValue.type==='right_img' && modelValue.items[itemId].type!=='left_img') || modelValue.items[itemId].type==='right_img' ? 'flex-row-reverse' : ''"
                >
                    <div class="w-[480px] h-[180px] bg-gray-200 flex items-center justify-center">
                        <div>
                            <label :for="'article-item-' + itemId">положение фото</label>
                            <select class="ml-4 py-0.5 rounded h-fit border-gray-200 mb-4" :id="'article-item-' + itemId" v-model="modelValue.items[itemId].type">
                                <option value="">не задано</option>
                                <option value="left_img">фото слева</option>
                                <option value="right_img">фото справа</option>
                            </select>
                        </div>

                    </div>
                    <TipTap class="border min-h-[120px]"
                            no-fix
                            icon-size="20"
                            v-model="modelValue.items[itemId].body"
                            placeholder="   введите текст рядом с фото'"
                    />
                </div>

                <TipTap class="border min-h-[80px]"
                        no-fix icon-size="20"
                        v-model="modelValue.items[itemId].ps"
                        placeholder="   введите послеблоковый текст'"
                />
                <div @click="deleteItem(itemId)"
                     class="absolute top-5 right-5  bg-red-600 text-white rounded-full cursor-pointer"
                     title="Удалить элемент"
                >
                    <CloseCross class="w-12"/>
                </div>
            </div>
            <div @click="(modelValue.items ??= []).push({'type':'', 'title':'', 'pre':'', 'body':'', 'ps':''})"
                 class="my-2 btn btn-green"
            >
                добавить элемент
            </div>
        </div>
    </div>
</template>
