<script setup>
import {inject} from "vue";

let form = inject('form');

</script>
<template>
    <div class="">
        <div class="flex items-center gap-6">
            <label class="block mb-2 text-xs" for="title">Заголовок</label>
            <input class="" id="title" v-model="form.datum['title']"/>
        </div>

        <div class="mt-4">
            <!-- Items -->
            <div class="mt-5 text-sm flex flex-col gap-1">
                <div v-for="(item, itemId) in form.datum.items" class="flex items-center gap-2">
                    <input v-model="form.datum.items[itemId].text"
                           class="text-sm"
                           placeholder="введите текст ссылки"
                           required/>
                    <input v-model="form.datum.items[itemId].href"
                           class="text-sm"
                           placeholder="введите url ссылки"
                           required/>
                    <div @click="form.datum.items.splice(itemId, 1)"
                         class="px-1.5 pb-0.5 font-bold bg-red-600 text-white rounded-full cursor-pointer">
                        ×
                    </div>
                </div>
                <div @click="(form.datum.items ??= []).push({'text':'', 'href':''})"
                     class="my-2 btn w-fit"
                >
                    добавить элемент
                </div>
            </div>
        </div>
    </div>
</template>
