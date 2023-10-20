<script setup>
import AirSummernote from "@/Pages/Admin/Partials/Summernote/AirSummernote.vue";
import {inject} from "vue";

let form = inject('form');

function summernoteSubmit(data, id) {
    form.datum[id] = data;
}
</script>
<template>
    <div class="main">
        <label class="block mb-2 text-sm">body</label>

        <AirSummernote class="hidden" v-on:submitted="summernoteSubmit" classes="rounded"
                       summernoteId="body"/>
        <textarea id="body" v-model="form.datum['body']">{{ form.datum['body'] }}</textarea>
    </div>
</template>
