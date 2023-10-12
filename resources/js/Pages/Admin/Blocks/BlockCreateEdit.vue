<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import {provide} from "vue";
import InputBlock from "@/Pages/Admin/Partials/InputBlock.vue";
import SelectBlock from "@/Pages/Admin/Partials/SelectBlock.vue";
import ArrowLeft from "vue-material-design-icons/ArrowLeft.vue";

let props = defineProps({block: Object,});

let form = useForm({
    page_id: props.block?.page_id ?? '',
    component_id: props.block?.component_id ?? '',
    order: props.block?.order ?? '',
    classes: props.block?.classes ?? '',
    inner_classes: props.block?.inner_classes ?? '',
    padding: props.block?.padding ?? '',
    datum: JSON.stringify(props.block?.datum) ?? '',
});

provide('form', form);

let submit = () => {
    if (props.block) {
        form.patch(route('blocks.update', props.block));
    } else {
        form.post(route('blocks.store'));
    }
};
</script>
<template>
    <Head title="Редактировать блок"/>

    <div class="pr-3">
        <!-- Back -->
        <Link :href="route('blocks.index')" class="w-fit hover:text-blue-500 flex items-center">
            <ArrowLeft class="text-xl pt-1 mr-3"/> к списку блоков
        </Link>

        <!-- Title -->
        <h1 class="mb-3 text-xl font-bold">{{ block ? 'Редактировать' : 'Создать' }} блок</h1>

        <form @submit.prevent="submit" class="">
            <SelectBlock label="Страница"
                         field="page_id"
                         :options="$page.props.pages"
                         valueField="id"
                         name-field="title"
            />

            <div class="mb-5">
                <label class="inline-block min-w-[100px]" for="component_id">Компонент</label>
                <!-- TODO replace with custom improved select -->
                <select class="ml-2 py-1.5 rounded w-48 text-xs" id="component_id" v-model="form.component_id">
                    <option v-for="component in $page.props.components" :value="component.id">
                        {{ component.id }} - {{ component.title }} - {{ component.type }}
                    </option>
                </select>

                <InputError :message="form.errors.component_id" class="absolute bg-white"/>
            </div>

            <InputBlock label="Порядок" field="order" input-type="number"/>
            <InputBlock label="Классы" field="classes"/>
            <InputBlock label="Классы" field="inner_classes"/>
            <InputBlock label="Отступы" field="padding"/>
            <InputBlock label="Данные" field="datum"/>

            <button type="submit" class="mt-8 btn btn-blue" :disabled="form.processing">Сохранить</button>
        </form>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
