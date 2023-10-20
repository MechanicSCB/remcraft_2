<script setup>
// import {ref} from "vue";
// import InputError from "@/Components/InputError.vue";
// import {useForm} from "@inertiajs/vue3";
// import HtmlForm from "@/Pages/Admin/Components/Datum/old/HtmlForm.vue";
// import MasonryForm from "@/Pages/Admin/Components/Datum/MasonryForm.vue";
// import CalculatorForm from "@/Pages/Admin/Components/Datum/Calculator/CalculatorForm.vue";
// import RecommendationForm from "@/Pages/Admin/Components/Datum/old/RecommendationForm.vue";
// import CostForm from "@/Pages/Admin/Components/Datum/old/CostForm.vue";
// import BannerForm from "@/Pages/Admin/Components/Datum/old/BannerForm.vue";
//
// let showModal = ref(false);
//
// let form = useForm({
//     title: '',
//     slug: '',
//     type: '',
//     datum: {},
// });
//
// const typeForms = {
//     'Html': HtmlForm,
//     'Masonry': MasonryForm,
//     'Calculator': CalculatorForm,
//     'Recommendation': RecommendationForm,
//     'Cost': CostForm,
//     'Banner': BannerForm,
// };

let submit = () => {
    form.post(route('components.store'));
    // showModal.value = false;
};
</script>
<template>
    <div>
        <!-- The selected component and a button to display modal -->
        <div @click="showModal=!showModal" class="btn btn-blue text-center">Создать компонент</div>

        <!-- Modal -->
        <div v-if="showModal" @click="showModal=false"
             class="fixed left-0 top-0 w-full h-screen py-2 px-4 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default overflow-y-auto">
                <h3 class="flex gap-2">
                    <Link href="">Создать компонент</Link>
                    <!-- TODO dev -->
                    <div class="mb-4 text-xs">datum: {{ form.datum }}</div>
                </h3>

                <form @submit.prevent="submit" class="">
                    <button type="submit" class="mt-8 btn btn-blue" :disabled="form.processing">
                        Сохранить
                    </button>

                    <div class="input-block">
                        <label for="title">Название компонента</label>
                        <input v-model="form.title" name="title" id="title" placeholder="Введите название компонента"
                               required/>
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
                            <option v-for="type in $page.props.componentTypes" :value="type">{{ type }}</option>
                        </select>
                        <InputError class="input-error" :message="form.errors.type"/>
                    </div>

                    <hr class="mb-4">
                    <!--<MasonryForm  v-model="form.datum"/>-->
                    <!--<input  v-model="form.datum"/>-->
                    <component :is="typeForms[form.type]" v-model="form.datum"/>

                </form>
            </div>
        </div>
    </div>
</template>
