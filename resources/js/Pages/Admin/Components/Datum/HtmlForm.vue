<script setup>
import AirSummernote from "@/Pages/Admin/Partials/Summernote/AirSummernote.vue";
import {inject} from "vue";

let props = defineProps({field: String, label:String});

let form = inject('form');

function summernoteSubmit(data, id) {
    form.datum[props.field ?? 'body'] = data;
}
</script>
<template>
    <div class="main">
        <label class="block mb-2 text-sm">{{ label ?? 'body' }}</label>

        <AirSummernote class="hidden" v-on:submitted="summernoteSubmit" classes="rounded"
                       :summernoteId="field ?? 'body'"/>
        <textarea :id="field ?? 'body'" v-model="form.datum[field ?? 'body']">{{ form.datum[field ?? 'body'] }}</textarea>
    </div>
</template>
