<script setup>
import {useForm} from "@inertiajs/vue3";
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
<template>
    <Head title="Редактировать компонент"/>

    <div class="pr-3">
        <!-- Back -->
        <Link :href="route('components.index')" >к списку компонентов</Link>

        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">{{ component ? 'Редактировать' : 'Создать' }} компонент</h1>

        <form @submit.prevent="submit" class="">
            <div class="input-block">
                <label for="title">Название компонента</label>
                <input v-model="form.title" name="title" id="title" placeholder="Введите название компонента" required/>
                <InputError class="input-error" :message="form.errors.title"/>
            </div>

            <div class="input-block">
                <label for="slug">slug</label>
                <input v-model="form.slug" name="slug" id="slug" placeholder="Введите слаг"/>
                <InputError class="input-error" :message="form.errors.slug"/>
            </div>

            <div class="input-block">
                <label for="type">Тип</label>
                <select v-model="form.type" id="type">
                    <option v-for="type in types" :value="type">{{ type }}</option>
                </select>
                <InputError class="input-error" :message="form.errors.type"/>
            </div>

            <hr class="mb-4">
            <component :is="typeForms[form.type]"/>

            <button type="submit" class="mt-8 btn btn-blue"
                           :disabled="form.processing">
                Сохранить
            </button>
        </form>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
