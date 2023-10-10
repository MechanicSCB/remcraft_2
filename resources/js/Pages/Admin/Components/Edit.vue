<script setup>
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {provide} from "vue";
import HtmlForm from "@/Pages/Admin/Components/Datum/HtmlForm.vue";
import MasonryForm from "@/Pages/Admin/Components/Datum/MasonryForm.vue";
import CalculatorForm from "@/Pages/Admin/Components/Datum/Calculator/CalculatorForm.vue";

let props = defineProps({component: Object,});

let form = useForm({
    title: props.component?.title ?? '',
    slug: props.component?.slug ?? '',
    type: props.component?.type ?? '',
    datum: props.component?.datum ?? {},
});

//  TODO replace to common shared data
const types = ['Html','Masonry','Calculator','Cost','Gallery','Pile','Recommendation','YoutubeChannel'];

const typeForms = {
    'Html': HtmlForm,
    'Masonry': MasonryForm,
    'Calculator': CalculatorForm,
};

provide('form', form);

let submit = () => {
    if(props.component){
        form.patch(route('components.update', props.component));
    }else {
        form.post(route('components.store'));
    }
};
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>

<template>
    <Head title="Редактировать компонент"/>

    <div class="pr-3">
        <!-- Back -->
        <Link :href="route('components.index')" >к списку компонентов</Link>

        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">{{ component ? 'Редактировать' : 'Создать' }} компонент</h1>

        <form @submit.prevent="submit" class="">
            <div class="mb-6">
                <label class="block mb-2 text-sm" for="title">Название компонента</label>

                <input v-model="form.title" class="border border-gray-400 p-2 w-full rounded" type="text"
                       name="title"
                       id="title"
                       placeholder="Введите название компонента"
                       required/>

                <InputError :message="form.errors.title" class="h-0"/>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm" for="slug">slug</label>

                <input v-model="form.slug" class="border border-gray-400 p-2 w-full rounded" type="text"
                       name="slug"
                       id="slug"
                       placeholder="Введите слаг"
                />

                <InputError :message="form.errors.slug" class="h-0"/>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm" for="type">Тип</label>

                <select v-model="form.type" id="type">
                    <option v-for="type in types" :value="type">{{ type }}</option>
                </select>

                <InputError :message="form.errors.type" class="h-0"/>
            </div>

            <hr class="mb-4">
            <component :is="typeForms[form.type]"/>

            <PrimaryButton type="submit"
                           class="mt-12 !block !bg-blue-500 hover:!bg-blue-600 !text-lg normal-case py-2 font-normal !mb-7"
                           :disabled="form.processing">Опубликовать
            </PrimaryButton>
        </form>
    </div>
</template>
