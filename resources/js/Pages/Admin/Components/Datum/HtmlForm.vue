<script setup>
import AirSummernote from "@/Pages/Admin/Partials/AirSummernote.vue";
import {inject} from "vue";

let form = inject('form');

function summernoteSubmit(data, id) {
    form.datum[id] = data;
}
</script>
<template>
    <label class="block mb-2 text-sm" for="component">body</label>

    <AirSummernote class="hidden" v-on:submitted="summernoteSubmit" classes="rounded"
                   summernoteId="body"/>
    <textarea id="body" v-model="form.datum['body']">{{ form.datum['body'] }}</textarea>
</template>
