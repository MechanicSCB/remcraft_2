<script setup>
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

defineProps({modelValue: String, errorMsg:String});
let selectedPage;

defineEmits(['update:modelValue']);

let showModal = ref(false);
</script>
<template>
    <div>
        <!-- The selected page and a button to display modal -->
        <div @click="showModal=!showModal" class="cursor-pointer hover:text-blue-500">
            <div v-if="selectedPage = $page.props.pages[modelValue]">
                {{ selectedPage.id }} - {{ selectedPage.title }}
            </div>
            <div v-else class="btn py-0.5">выберите страницу</div>

            <!-- Form Errors  -->
            <FormErrorMsg :error-msg="errorMsg"/>
        </div>

        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-fit bg-white border p-5 cursor-default">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <!--  Pages List  -->
                <div class="pt-10 max-h-full overflow-y-auto">
                    <div v-for="page in $page.props.pages" :key="page.id">
                        <!-- Item -->
                        <div @click="$emit('update:modelValue', page.id.toString());showModal=false"
                             class="w-fit cursor-pointer hover:text-blue-500"
                        >
                            {{ page.id }} - {{ page.title }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
