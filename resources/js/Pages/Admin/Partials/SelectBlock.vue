<script setup>
import {inject} from "vue";
import InputError from "@/Components/InputError.vue";

let form = inject('form');

defineProps({
    label:String,
    field:String,
    options:Array,
    valueField:String,
    nameField:String,
    nullable:Boolean,
});
</script>
<template>
    <div class="mb-5">
        <label class="inline-block min-w-[100px]" :for="field">{{ label }}</label>
        <select class="ml-2 py-0 rounded" :id="field" v-model="form[field]">
            <option v-if="nullable" value="">--</option>
            <option v-for="option in options"
                    :value="option[valueField ?? 'value'] ?? option"
            >
                {{ option[nameField ?? 'name'] ?? option }}</option>
        </select>
        <InputError :message="form.errors[field]" class="absolute bg-white"/>
    </div>
</template>
