<script setup>
import {ref} from "vue";
import axios from "axios";
import {useForm} from "@inertiajs/vue3";
import MasonryForm from "@/Pages/Admin/Components/Datum/MasonryForm.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import SelectComponentType from "@/Pages/Admin/Partials/SelectComponentType.vue";
import HtmlForm from "@/Pages/Admin/Components/Datum/HtmlForm.vue";

let props = defineProps({componentId: Number});
let component = ref({});
let showModal = ref(false);

let form = useForm({
    title: '',
    slug: '',
    type: '',
    datum: {},
});

let showComponentModal = () => {
    if (props.componentId) {
        axios.get('/components/' + props.componentId + '/get-data')
            .catch(error => {
                console.log(error.toJSON());
            })
            .then(response => {
                component.value = response.data;
                form.title = component.value.title;
                form.slug = component.value.slug;
                form.type = component.value.type;
                form.datum = component.value.datum;
                showModal.value = true;
            });
    } else {
        showModal.value = true;
    }
};

const typeForms = {
    'Html': HtmlForm,
    'Masonry': MasonryForm,
};

let submit = () => {
    if (component.value.id) {
        form.put(route('components.update', component.value.id));
    } else {
        form.post(route('components.store'), {
            onSuccess: () => showModal.value = false,
        });
    }
};
</script>
<template>
    <div>
        <div @click="showComponentModal" class="cursor-pointer"><slot/></div>

        <div v-if="showModal" @click="showModal=false"
             class="fixed left-0 top-0 w-full h-screen py-2 px-4 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default overflow-y-auto">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <h3 v-if="component.id" class="flex gap-2">Редактировать компонент id:{{ component.id }}</h3>
                <h3 v-else class="flex gap-2">Создать компонент</h3>

                <form @submit.prevent="submit" class="">
                    <button type="submit" class="mt-8 btn btn-blue" :disabled="form.processing">
                        Сохранить
                    </button>

                    <LabelInput v-model="form.title"
                                placeholder="Введите название компонента"
                                :error-msg="form.errors.title"
                                required
                    >имя</LabelInput>

                    <SelectComponentType v-model="form.type" :error-msg="form.errors.type"/>

                    <hr class="mb-4">
                    <component :is="typeForms[form.type]" v-model="form.datum"/>
                </form>
            </div>
        </div>

    </div>
</template>
