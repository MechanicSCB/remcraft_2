<script setup>
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

let props = defineProps({page: Object,});

let form = useForm({
    title: props.page.title,
    slug: props.page.slug,
    blocks: props.page.blocks,
});

let submit = () => {
    form.patch(route('pages.update', props.page));
};
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>

<template>
    <Head title="Редактировать страницу"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">Редактировать страницу</h1>

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

                <!-- Page Blocks -->
                <div v-for="(block, id) in page.blocks" class="my-3">
                    <Link :href="route('blocks.edit', block.id)">Блок {{ id }} - {{ block.component }}</Link>
                </div>

                <PrimaryButton type="submit"
                               class="mt-12 !block !bg-blue-500 hover:!bg-blue-600 !text-lg normal-case py-2 font-normal !mb-7"
                               :disabled="form.processing">Опубликовать
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
