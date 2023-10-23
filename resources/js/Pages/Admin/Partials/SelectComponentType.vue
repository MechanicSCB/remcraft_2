<script setup>
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

defineProps({modelValue: String, errorMsg:String});
let selectedType;

defineEmits(['update:modelValue']);

let showModal = ref(false);
</script>
<template>
    <div>
        <!-- The selected component type and a button to display modal -->
        <div @click="showModal=!showModal" class="cursor-pointer hover:text-blue-500">
            <div v-if="selectedType = modelValue">{{ selectedType }}</div>
            <div v-else class="btn">выберите тип</div>
            <!-- Form Errors  -->
            <FormErrorMsg :error-msg="errorMsg"/>
        </div>

        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed z-10 left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-fit bg-white border p-5 cursor-default">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <!--  Components Types List  -->
                <div class="pt-10 max-h-full overflow-y-auto">
                    <div v-for="(type,id) in $page.props.componentTypes" :key="id">
                        <!-- Type -->
                        <div @click="$emit('update:modelValue', type);showModal=false"
                             class="w-fit cursor-pointer hover:text-blue-500"
                        >
                            {{ type }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
