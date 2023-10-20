<script setup>
import {inject} from "vue";
import InputError from "@/Components/InputError.vue";

let form = inject('form');

defineProps({
    label:String,
    field:String,
    placeholder:String,
    required:Boolean,
    inputType:String,
});
</script>
<template>
    <div class="mb-5">
        <label v-if="label" class="inline-block min-w-[100px]" :for="field">{{ label }}</label>
        <input class="ml-2 py-0 rounded border-gray-200"
               v-model="form[field]"
               :id="field"
               :placeholder="placeholder"
               :required="required"
               :type="inputType"
        />
        <InputError :message="form.errors[field]" class="absolute bg-white"/>
    </div>
</template>
