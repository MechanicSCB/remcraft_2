<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import {provide} from "vue";
import HtmlForm from "@/Pages/Admin/Components/Datum/HtmlForm.vue";
import MasonryForm from "@/Pages/Admin/Components/Datum/MasonryForm.vue";
import CalculatorForm from "@/Pages/Admin/Components/Datum/Calculator/CalculatorForm.vue";
import RecommendationForm from "@/Pages/Admin/Components/Datum/RecommendationForm.vue";
import CostForm from "@/Pages/Admin/Components/Datum/CostForm.vue";

let props = defineProps({block: Object,});

let form = useForm({
    title: '',
    slug: '',
    type: '',
    datum: {},
});

//  TODO replace to common shared data
const types = ['Html','Masonry','Calculator','Cost','Gallery','Pile','Recommendation','YoutubeChannel'];

const typeForms = {
    'Html': HtmlForm,
    'Masonry': MasonryForm,
    'Calculator': CalculatorForm,
    'Recommendation': RecommendationForm,
    'Cost': CostForm,
};

provide('form', form);

let submit = () => {
    form.post(route('components.store'));
};
</script>
<template>
    <Head title="Редактировать компонент"/>

    <div class="pr-3">
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">
            Создать компонент
        </h1>

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
