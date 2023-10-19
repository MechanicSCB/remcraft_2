<script setup>
import {ref} from "vue";

defineEmits(['update:modelValue']);

let modelVal = ref({});
</script>
<template>
    <div>
        <!-- Search in title -->
        <input ref="search" @input="modelVal.search = $refs.search.value;$emit('update:modelValue', modelVal)" type="text">

        <!-- Select Page -->
        <select>
            <option @click="delete modelVal.page_id;$emit('update:modelValue', modelVal)">все страницы</option>
            <option v-for="page in $page.props.pages"
                    @click="modelVal.page_id = page.id;$emit('update:modelValue', modelVal)"
            >
                {{ page.id }} - {{ page.title }}
            </option>
        </select>

        <!-- Select Type -->
        <select>
            <option @click="delete modelVal.type;$emit('update:modelValue', modelVal)">все типы</option>
            <option v-for="type in $page.props.componentTypes"
                    @click="modelVal.type = type;$emit('update:modelValue', modelVal)"
            >
                {{ type }}
            </option>
        </select>
    </div>
</template>
