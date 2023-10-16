<script setup>
import {inject} from "vue";
import AirSummernote from "@/Pages/Admin/Partials/Summernote/AirSummernote.vue";
import HtmlForm from "@/Pages/Admin/Components/Datum/HtmlForm.vue";

let form = inject('form');
</script>
<template>
    <div class="">
        <div class="flex items-center gap-6">
            <label class="block mb-2 text-xs" for="title">Заголовок</label>
            <input class="" id="title" v-model="form.datum['title']"/>
        </div>
        <HtmlForm field="description" label="Описание"/>

        <div class="mt-4">
            <!-- Items -->
            <div class="mt-5 text-sm flex flex-col gap-1">
                <div v-for="(item, itemId) in form.datum.items">
                    <div class="flex items-center gap-2">
                        <input v-model="form.datum.items[itemId].name"
                               class="text-sm"
                               placeholder="введите имя"
                               required/>
                        <input v-model="form.datum.items[itemId].price"
                               class="text-sm"
                               placeholder="введите цену"
                               required/>
                        <input v-model="form.datum.items[itemId].measure"
                               class="text-sm"
                               placeholder="введите единицу измерения"
                               required/>
                        <div @click="form.datum.items.splice(itemId, 1)"
                             class="px-1.5 inline pb-0.5 font-bold bg-red-600 text-white rounded-full cursor-pointer">
                            ×
                        </div>

                    </div>

                    <div class="main">
                        <textarea class="w-full min-h-[140px]" v-model="form.datum.items[itemId].expand"></textarea>
                    </div>
                </div>
                <div @click="(form.datum.items ??= []).push({'name':'', 'price':'', 'expand':'', 'description':''})"
                     class="my-2 btn w-fit"
                >
                    добавить элемент
                </div>
            </div>
        </div>
    </div>
</template>
