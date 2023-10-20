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
            Родитель:
            {{ $page.props.nodesTitles[modelValue] ?? 'выберите родителя' }}
        </div>

        <!--  Select List  -->
        <div v-if="showList" class="node-select-list absolute bg-white px-2 py-1 rounded w-fit border" @click="showList=false">
            <span @click="$emit('update:modelValue', '1')">Главное меню</span>
            <div v-for="item in $page.props.menu[1].nodes" class="ml-4">
                <span @click="$emit('update:modelValue', item.path)" class="">{{ item.title }}</span>

                <div v-for="subItem in item.nodes" class="ml-4">
                    <span @click="$emit('update:modelValue', subItem.path)">{{ subItem.title }}</span>

                    <div v-for="subSubItem in subItem.nodes" class="ml-4">
                        <span @click="$emit('update:modelValue', subSubItem.path)">{{ subSubItem.title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.node-select-list span{
    @apply cursor-pointer hover:text-blue-500;
}
</style>
