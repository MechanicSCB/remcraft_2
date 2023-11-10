<script setup>
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

defineProps({modelValue: String, errorMsg:String});
let selectedPage;

defineEmits(['update:modelValue']);

let showModal = ref(false);
let filterFields = ref({'search':''});
let filterItems = (pages) => {
    pages = Object.values(pages).filter(function (v){
        let res = true;

        if(filterFields.value?.search){
            res = res && v.title.toLowerCase().includes(filterFields.value.search.toLowerCase());
        }

        return res;
    })

    return pages;
};

</script>
<template>
    <div>
        <!-- The selected page and a button to display modal -->
        <div @click="showModal=!showModal" class="cursor-pointer hover:text-blue-500 overflow-y-auto">
            <div v-if="selectedPage = $page.props.pages[modelValue]">
                стр.{{ selectedPage.id }} - {{ selectedPage.title }}
            </div>
            <div v-else><slot/></div>

            <!-- Form Errors  -->
            <FormErrorMsg :error-msg="errorMsg"/>
        </div>

        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed z-10 left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-fit min-w-[350px] h-full bg-white border p-5 cursor-default">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <!-- Modal Header -->
                <div class="absolute pb-2 bg-[rgba(255,255,255,0.8)] flex items-center gap-2 mr-10">
                    <!-- Filter Components list -->
                    <!-- Search in title -->
                    <input ref="search"
                           v-model="filterFields.search"
                           type="text"
                           placeholder="поиск по имени"
                           class="py-0.5 border-gray-200"
                    >
                </div>

                <!--  Pages Table  -->
                <div class="pt-10 max-h-full overflow-y-auto">
                    <div>Страницы найдено: {{ filterItems($page.props.pages).length }}</div>

                    <div v-for="page in filterItems($page.props.pages)" :key="page.id">
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
