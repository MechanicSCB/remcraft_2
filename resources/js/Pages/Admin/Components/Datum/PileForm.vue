<script setup>
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({modelValue:Object, galleries:Array});
</script>
<template>
    <LabelInput v-model="modelValue['title']"/>
    <select v-model="modelValue['prev']">
        <option :value=true>с превью</option>
        <option :value=false>без превью</option>
    </select>

    <!-- Links -->
    <div class="mt-5 text-sm flex flex-col gap-1">
        <div v-for="(item, itemId) in modelValue.links" class="flex items-center gap-2">
            <input v-model="modelValue.links[itemId].gallerySlug"
                   class="text-sm w-[450px]"
                   placeholder="введите слаг галереи"
                   required/>
            <input v-model="modelValue.links[itemId].href"
                   class="text-sm w-[650px]"
                   placeholder="введите url ссылки"
                   required/>
            <div @click="modelValue.links.splice(itemId, 1)"
                 class="px-1.5 pb-0.5 font-bold bg-red-600 text-white rounded-full cursor-pointer">
                ×
            </div>
        </div>
        <div @click="(modelValue.links ??= []).push({'gallerySlug':'', 'href':''})"
             class="my-2 btn w-fit"
        >
            добавить ссылку
        </div>
    </div>

    <!--  Galleries  -->
    <div v-for="gallery in galleries" :key="gallery.id">
        {{ gallery.slug }}
    </div>
</template>
