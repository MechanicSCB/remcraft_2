<script setup>
import {ref, useAttrs} from "vue";

let emits = defineEmits(['update:modelValue']);

const attrs = useAttrs()
// let filter = ref(attrs.modelValue);
let filter = ref({
    'search':attrs.modelValue?.search ?? '',
    'page_id':attrs.modelValue?.page_id ?? null,
    'type':attrs.modelValue?.type ?? null,
});
</script>
<script>

</script>
<template>
    <div>
        <!-- Search in title -->
        <input ref="search"
               v-model="filter.search"
               @input="$emit('update:modelValue', filter)"
               type="text"
               placeholder="поиск по имени"
               class="py-0.5 border-gray-200"
        >

        <!-- Select Page -->
        <select v-model="filter.page_id"
                @change="$emit('update:modelValue', filter)"
                class="py-0.5 border-gray-200"
        >
            <option :value="null">все страницы</option>
            <option :value="-1">непривязанные</option>
            <option v-for="page in $page.props.pages" :value="page.id">
                {{ page.id }} - {{ page.title }}
            </option>
        </select>

        <!-- Select Type -->
        <select v-model="filter.type"
                @change="$emit('update:modelValue', filter)"
                class="py-0.5 border-gray-200"
        >
            <option :value="null">все типы</option>
            <option v-for="type in $page.props.componentTypes">{{ type }}</option>
        </select>
    </div>
</template>
