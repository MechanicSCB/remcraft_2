<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

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
            <div class="">
                <div class="mb-6">
                    <label class="block mb-2 text-sm" for="title">Название страницы</label>

                    <input v-model="form.title" class="border border-gray-400 p-2 w-full rounded" type="text"
                           name="title"
                           id="title"
                           placeholder="Введите название страницы"
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

                <PrimaryButton type="submit"
                               class="mt-12 !block !bg-blue-500 hover:!bg-blue-600 !text-lg normal-case py-2 font-normal !mb-7"
                               :disabled="form.processing">Опубликовать
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
