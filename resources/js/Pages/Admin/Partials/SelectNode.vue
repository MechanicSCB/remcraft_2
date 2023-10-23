<script setup>

import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

let showModal = ref(false);
</script>

<template>
    <div>
        <!-- Selected Item -->
        <div @click="showModal=!showModal" class="cursor-pointer hover:text-blue-500">
            Родитель:
            {{ $page.props.nodesTitles[modelValue] ?? 'выберите родителя' }}
        </div>


        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed z-10 left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-fit min-w-[350px] h-full bg-white border p-5 cursor-default">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false"
                            class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <!--  Nodes  -->
                <div class="node-select-list pt-10 max-h-full overflow-y-auto pr-2">
                    <div v-for="item in $page.props.menu[1].nodes" class="ml-4">
                        <span @click="$emit('update:modelValue', item.path);showModal=false">{{ item.title }}</span>

                        <div v-for="subItem in item.nodes" class="ml-4">
                            <span @click="$emit('update:modelValue', subItem.path);showModal=false">{{ subItem.title }}</span>

                            <div v-for="subSubItem in subItem.nodes" class="ml-4">
                                <span @click="$emit('update:modelValue', subSubItem.path);showModal=false">{{ subSubItem.title }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.node-select-list span {
    @apply cursor-pointer hover:text-blue-500;
}
</style>
