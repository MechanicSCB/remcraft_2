<script setup>
import {useForm} from "@inertiajs/vue3";
import {provide} from "vue";
import SelectComponent from "@/Pages/Admin/Partials/SelectComponent.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import CloseCross from "@/Svg/CloseCross.vue";

let props = defineProps({gallery: Object});

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
        <LabelInput v-model="form.title" :error-msg="form.errors.title" placeholder="Введите имя галереи" required>Имя галереи</LabelInput>
        <LabelInput v-model="form.slug" :error-msg="form.errors.slug" placeholder="Введите слаг">слаг</LabelInput>
        <div class="flex gap-2">
            <SelectComponent class="mb-4" v-model="form.component_id"/>
            <div v-if="form.component_id" class="hover:text-red-600 cursor-pointer"  @click="form.component_id=null; submit()"><CloseCross class="w-6"/></div>
        </div>
        <LabelInput v-model="form.order" :error-msg="form.errors.order" placeholder="№ п/п" type="number">№ п/п</LabelInput>

        <button type="submit" class="mt-4 btn btn-blue" :disabled="form.processing">
            Сохранить
        </button>
    </form>
</template>
