<script setup>
import {ref} from 'vue';
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

defineProps({
    modelValue: String,
    name: String,
    errorMsg: String,
    type: String,
    placeholder: String,
    required: Boolean,
    inputClass: String,
    labelClass: String,
});

defineEmits(['update:modelValue']);

const labelInput = ref(null);
const input = ref(null);
</script>
<template>
    <div class="mb-4" ref="labelInput">
        <label :class="labelClass" class="inline-block" :for="name">
            <slot/>
        </label>
        <input class="ml-2 py-0 rounded border-gray-200 shadow-sm"
               :id="name"
               :name="name"
               :value="modelValue"
               :class="inputClass"
               @input="$emit('update:modelValue', $event.target.value)"
               :type="type ?? 'text'"
               :placeholder="placeholder ?? ''"
               :required="required ?? false"
        >

        <FormErrorMsg :error-msg="errorMsg"/>
    </div>
</template>
