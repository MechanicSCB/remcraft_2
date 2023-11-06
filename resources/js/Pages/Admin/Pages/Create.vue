<script setup>
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import {ref} from "vue";

let props = defineProps({page: Object,});

let form = useForm({
    title: '',
    slug: '',
    published_at: null,
});

let publish = ref(true);

let submit = () => {
    if(publish.value){
        form.published_at = new Date().toISOString().replace("T"," ").substring(0, 19);
    }else{
        form.published_at = null;
    }

    form.post(route('pages.store'));
};
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>

<template>
    <Head title="Создать страницу"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">Создать страницу</h1>

        <form @submit.prevent="submit" class="">
            <LabelInput input-class="w-[400px]" v-model="form.title" :error-msg="form.errors.title" name="pageTitle">Название страницы</LabelInput>
            <LabelInput input-class="w-[400px]" v-model="form.slug" :error-msg="form.errors.slug" name="pageSlug">slug</LabelInput>
            <div @click="publish = ! publish"
                 class="w-[150px] text-center rounded px-1 text-white cursor-pointer"
                :class="publish ? 'bg-green-600' : 'bg-gray-600'"
            >
                {{ publish ? 'опубликована' : 'не опубликована' }}
            </div>

            <button class="mt-4 btn btn-blue" :disabled="form.processing">
                Создать
            </button>
        </form>
    </div>
</template>
