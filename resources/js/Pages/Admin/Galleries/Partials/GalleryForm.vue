<script setup>
import {useForm} from "@inertiajs/vue3";
import {provide} from "vue";
import SelectComponent from "@/Pages/Admin/Partials/SelectComponent.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({gallery: Object,});

let form = useForm({
    title: props.gallery?.title ?? '',
    slug: props.gallery?.slug ?? '',
    component_id: props.gallery?.component_id ?? '',
    order: props.gallery?.order ?? '',
    images: props.gallery?.images ?? [],
    datum: props.gallery?.datum ?? {},
});

provide('form', form);


let submit = () => {
    if (props.gallery) {
        form.patch(route('galleries.update', props.gallery));
    } else {
        form.post(route('galleries.store'));
    }
};
</script>
<template>
    <form @submit.prevent="submit">
        <LabelInput v-model="form.title" :error-msg="form.errors.title" placeholder="Введите имя галереи" required>Имя галереи</LabelInput>
        <LabelInput v-model="form.slug" :error-msg="form.errors.slug" placeholder="Введите слаг">слаг</LabelInput>
        <SelectComponent class="mb-4" v-model="form.component_id"/>
        <LabelInput v-model="form.order" :error-msg="form.errors.order" placeholder="№ п/п" type="number">№ п/п</LabelInput>

        <button type="submit" class="mt-4 btn btn-blue" :disabled="form.processing">
            Сохранить
        </button>
    </form>
</template>
