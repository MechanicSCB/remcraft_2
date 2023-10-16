<script setup>
import {inject, provide, ref} from "vue";
import {router, useForm} from "@inertiajs/vue3";
import HtmlForm from "@/Pages/Admin/Components/Datum/HtmlForm.vue";
import MasonryForm from "@/Pages/Admin/Components/Datum/MasonryForm.vue";
import CalculatorForm from "@/Pages/Admin/Components/Datum/Calculator/CalculatorForm.vue";
import RecommendationForm from "@/Pages/Admin/Components/Datum/RecommendationForm.vue";
import CostForm from "@/Pages/Admin/Components/Datum/CostForm.vue";
import BannerForm from "@/Pages/Admin/Components/Datum/BannerForm.vue";

let form = useForm({
    title: '',
    slug: '',
    type: '',
    datum: {},
});

provide('form', form);

let showModal = ref(false);

const types = ['Html','Masonry','Calculator','Cost','Gallery','Pile','Recommendation','YoutubeChannel','Banner'];

const typeForms = {
    'Html': HtmlForm,
    'Masonry': MasonryForm,
    'Calculator': CalculatorForm,
    'Recommendation': RecommendationForm,
    'Cost': CostForm,
    'Banner': BannerForm,
};

let submit = () => {
    form.post(route('components.store'));
    showModal.value = false;
};
</script>
<template>
    <!-- The selected component and a button to display modal -->
    <div @click="showModal=true" class="btn">создать компонент</div>


    <!-- Modal -->
    <div v-if="showModal"
         @click="showModal=false"
         class="fixed left-0 top-0 w-full h-screen p-10 bg-[rgba(0,0,0,0.7)] cursor-pointer">
        <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default  overflow-y-auto">
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
    </div>

</template>
