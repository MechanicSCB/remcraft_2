<script setup>
import {onMounted, ref} from 'vue';
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

defineProps({
    modelValue: String,
    errorMsg: String,
    type: String,
    placeholder: String,
    required: Boolean,
});

defineEmits(['update:modelValue']);

const labelInput = ref(null);
const input = ref(null);
</script>
<template>
    <div class="mb-4" ref="labelInput">
        <label class="inline-block min-w-[100px]">
            <slot/>
            <input class="ml-2 py-0 rounded border-gray-200 shadow-sm"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"
                   :type="type ?? 'text'"
                   :placeholder="placeholder ?? ''"
                   :required="required ?? false"
            >
        </label>

        <FormErrorMsg :error-msg="errorMsg"/>
    </div>
</template>
