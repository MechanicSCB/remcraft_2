<script setup>
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({page: Object,});

let form = useForm({
    title: '',
    slug: '',
});

let submit = () => {
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

            <button class="btn btn-blue" :disabled="form.processing">
                Опубликовать
            </button>
        </form>
    </div>
</template>
