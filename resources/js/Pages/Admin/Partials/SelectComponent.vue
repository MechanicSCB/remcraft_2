<script setup>
import {ref} from "vue";
import FilterComponents from "@/Pages/Admin/Partials/FilterComponents.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import ModalEditComponent from "@/Pages/Admin/Components/Partials/ModalEditComponent.vue";
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

defineProps({modelValue: String, errorMsg:String});
let selectedComponent;

defineEmits(['update:modelValue']);

let showModal = ref(false);
let filterFields = ref({'search':'','page_id':-1,'type':null});
let filterItems = (components) => {
    components = Object.values(components).filter(function (v){
        let res = true;

        if(filterFields.value?.search){
            res = res && v.title.toLowerCase().includes(filterFields.value.search.toLowerCase());
        }
        if(filterFields.value?.type){
            res = res && v.type===filterFields.value.type
        }
        if(filterFields.value?.page_id){
            if(filterFields.value.page_id > 0){
                res = res && v.pages.includes(filterFields.value.page_id)
            }else{
                res = res && v.pages.length===0;
            }
        }

        return res;
    })

    return components;
};
</script>
<template>
    <div>
        <!-- The selected component and a button to display modal -->
        <div>
            <div @click="showModal=!showModal" class="relative cursor-pointer hover:text-blue-500">
                <div v-if="selectedComponent = $page.props.components[modelValue]">
                    {{ selectedComponent.id }} - {{ selectedComponent.title }} - {{ selectedComponent.type }}
                </div>
                <div v-else class="btn py-0.5">выберите компонент</div>
                <!-- Form Errors  -->
                <FormErrorMsg :error-msg="errorMsg"/>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <!-- Modal Header -->
                <div class="absolute pb-2 bg-[rgba(255,255,255,0.8)] flex items-center gap-2 mr-10">
                    <!-- Clean filter -->
                    <CloseCross @click="filterFields={'search':'','page_id':null,'type':null}"
                                class="w-5 cursor-pointer text-gray-500 hover:text-black"
                    />

                    <!-- Filter Components list -->
                    <FilterComponents v-model="filterFields"/>

                    <!--  Create Component  -->
                    <ModalEditComponent>
                        <div class="btn btn-blue text-center">Создать компонент</div>
                    </ModalEditComponent>
                </div>

                <!--  Components Table  -->
                <div class="pt-10 max-h-full overflow-y-auto">
                    <div v-for="component in filterItems($page.props.components)" :key="component.id">
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
    </div>
</template>
