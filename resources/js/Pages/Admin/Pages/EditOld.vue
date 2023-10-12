<script setup>
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import BlockShow from "@/Pages/Pages/Partials/BlockShow.vue";

let props = defineProps({page: Object,});

let form = useForm({
    title: props.page.title,
    slug: props.page.slug,
    blocks: props.page.blocks,
});

let blockForm = useForm({
    page_id: props.page.id,
    order: 0,
    component_id: null,
    classes: null,
    inner_classes: null,
});

let submit = () => {
    form.patch(route('pages.update', props.page));
};

let submitBlock = () => {
    blockForm.post(route('blocks.store'));
};
</script>
<template>
    <Head title="Редактировать страницу"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-xl font-bold">Редактировать страницу</h1>

        <!-- Title&Slug Form -->
        <form @submit.prevent="submit">
            <div class="flex gap-6">
                <div class="input-block">
                    <label for="title">Название страницы</label>
                    <input v-model="form.title" id="title" placeholder="Введите название страницы" required/>
                    <InputError :message="form.errors.title" class="input-error"/>
                </div>

                <div class="input-block">
                    <label for="slug">slug</label>
                    <input v-model="form.slug" id="slug" placeholder="Введите слаг"/>
                    <InputError :message="form.errors.slug" class="input-error"/>
                </div>

                <button type="submit" class="btn btn-blue" :disabled="form.processing">Опубликовать</button>
            </div>
        </form>


        <!-- Add Block -->
        <div>
            <form @submit.prevent="submitBlock">
                <div class="">
                    <div class="input-block">
                        <label for="component_id">Компонент</label>
                        <input v-model="blockForm.component_id" id="component_id" placeholder="Выберите компонент" required/>
                        <InputError :message="blockForm.errors.component_id" class="input-error"/>
                    </div>

                    <div class="input-block">
                        <label for="classes">Классы</label>
                        <select v-model="blockForm.classes" id="classes">
                            <option value="">--</option>
                            <option value="block-gray">block-gray</option>
                            <option value="block-dark">block-dark</option>
                        </select>
                        <InputError :message="blockForm.errors.classes" class="input-error"/>
                    </div>

                    <div class="input-block">
                        <label for="inner_classes">Внутренние классы</label>
                        <select v-model="blockForm.inner_classes" id="inner_classes">
                            <option value="">--</option>
                            <option value="block-container">block-container</option>
                        </select>
                        <InputError :message="blockForm.errors.inner_classes" class="input-error"/>
                    </div>

                    <button type="submit" class="btn btn-blue" :disabled="blockForm.processing">Опубликовать</button>
                </div>
            </form>
        </div>

        <!-- Page Blocks -->
        <div class="max-h-[calc(100vh-300px)] overflow-y-auto">
            <div v-for="(block, id) in page.blocks">
                <Link :href="route('blocks.edit', block.id)">
                    <BlockShow class="main" :block="block"/>
                </Link>
            </div>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
