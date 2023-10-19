<script setup>

import {ref} from "vue";

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

let showList = ref(false);
</script>

<template>
    <div>
        <!-- Selected Item -->
        <div @click="showList=!showList" class="cursor-pointer hover:text-blue-500">
            Страница:
            {{ $page.props.pages[modelValue]?.title ?? 'страница не выбрана' }}
        </div>

        <!--  Select List  -->
        <div v-if="showList" class="node-select-list absolute bg-white px-2 py-1 rounded w-fit border" @click="showList=false">
            <div v-for="page in $page.props.pages" class="ml-4">
                <span @click="$emit('update:modelValue', page.id)" class="">{{ page.title }}</span>
            </div>
        </div>
    </div>
</template>
<style>
.node-select-list span{
    @apply cursor-pointer hover:text-blue-500;
}
</style>
