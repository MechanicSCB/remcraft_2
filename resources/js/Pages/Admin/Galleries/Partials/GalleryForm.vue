<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

let props = defineProps({gallery: Object,});

let form = useForm({
    title: props.gallery?.title ?? '',
    slug: props.gallery?.slug ?? '',
    component_id: props.gallery?.component_id ?? '',
    order: props.gallery?.order ?? '',
    images: props.gallery?.images ?? [],
    datum: props.gallery?.datum ?? {},
});

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
        <div class="input-block">
            <label for="title">Название галереи</label>
            <input class=" " v-model="form.title" id="title" placeholder="Введите название галереи" required/>
            <InputError class="input-error" :message="form.errors.title"/>
        </div>

        <div class="input-block">
            <label for="slug">slug</label>
            <input v-model="form.slug" id="slug" placeholder="Введите слаг"/>
            <InputError :message="form.errors.slug" class="h-0"/>
        </div>

        <div class="input-block">
            <label for="component_id">Id компонента</label>
            <input v-model="form.component_id" id="component_id" placeholder="Введите Id компонента"/>
            <InputError :message="form.errors.component_id" class="h-0"/>
        </div>

        <div class="input-block">
            <label for="order">Порядковый номер</label>
            <input v-model="form.order" id="order" placeholder="Введите порядковый номер"/>
            <InputError :message="form.errors.order" class="h-0"/>
        </div>

        <button type="submit" class="mt-4 btn btn-blue" :disabled="form.processing">
            Сохранить
        </button>
    </form>
</template>
