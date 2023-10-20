<script setup>
import {inject} from "vue";
import HtmlForm from "@/Pages/Admin/Components/Datum/old/HtmlForm.vue";

let form = inject('form');

</script>
<template>
    <div class="">
        <HtmlForm field="text_1" label="Текст 1"/>
        <HtmlForm field="text_2" label="Текст 2"/>
    </div>
</template>
