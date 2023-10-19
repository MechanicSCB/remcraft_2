<script setup>
import {ref} from "vue";
import FilterComponents from "@/Pages/Admin/Partials/FilterComponents.vue";
import CloseCross from "@/Svg/CloseCross.vue";

defineProps({modelValue: String,});
let selectedComponent;

defineEmits(['update:modelValue']);

let showModal = ref(true);
let filterFields = ref(null);
let filter = (components) => {
    components = Object.values(components).filter(function (v){
        let res = true;

        if(filterFields.value?.search){
            res = res && v.title.includes(filterFields.value.search);
        }
        if(filterFields.value?.type){
            res = res && v.type===filterFields.value.type
        }
        if(filterFields.value?.page_id){
            res = res && v.page_id===filterFields.value.page_id
        }

        return res;
    })

    return components;
};
</script>
<template>
    <div>
        <!-- The selected component and a button to display modal -->
        <div @click="showModal=!showModal" class="cursor-pointer hover:text-blue-500 flex gap-2 items-center">
            <div v-if="selectedComponent = $page.props.components[modelValue]">
                {{ selectedComponent.id }} - {{ selectedComponent.title }} - {{ selectedComponent.type }}
            </div>
            <div v-else class="btn">выберите компонент</div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default overflow-y-auto">
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer text-gray-500 hover:text-black"/>
                <FilterComponents v-model="filterFields"/>
                <!--  Components Table  -->
                <div v-for="component in filter($page.props.components)" :key="component.id">
                    <!-- Item -->
                    <div @click="$emit('update:modelValue', component.id.toString());showModal=false"
                         class="w-fit cursor-pointer hover:text-blue-500"
                    >
                        {{ component.id }} - {{ component.title }} - {{ component.type }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
