<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {onMounted, provide} from "vue";
import InputBlock from "@/Pages/Admin/Partials/InputBlock.vue";
import SelectBlock from "@/Pages/Admin/Partials/SelectBlock.vue";
import ComponentCreateEdit from "@/Pages/Admin/Components/ComponentCreateEdit.vue";
import ArrowLeftIcon from "@/Svg/ArrowLeft.vue";
import SelectComponent from "@/Pages/Admin/Partials/SelectComponent.vue";

let props = defineProps({block: Object});

let form = useForm({
    page_id: props.block?.page_id ?? '',
    component_id: props.block?.component_id ?? '',
    order: props.block?.order ?? '',
    classes: props.block?.classes ?? '',
    inner_classes: props.block?.inner_classes ?? '',
    style: props.block?.style ?? '',
    pt: props.block?.pt ?? '',
    pb: props.block?.pb ?? '',
    datum: JSON.stringify(props.block?.datum) ?? '',
});

// TODO remove provide
provide('form', form);

let submit = () => {
    if (props.block) {
        form.patch(route('blocks.update', props.block));
    } else {
        form.post(route('blocks.store'));
    }
};

onMounted(() => {
    setQueryArgsToFilterForm();
});

let setQueryArgsToFilterForm = () => {
    // request_all added to HandleInertiaRequests.php
    let fields = router.page.props.ziggy.request_all;

    for(let [field, val] of Object.entries(fields)){
        form[field] = val;
    }
};

</script>
<template>
    <Head title="Редактировать блок"/>

    <div class="pr-3">
        <!-- Back -->
        <Link v-if="block" :href="route('pages.edit', block.page_id)" class="w-fit hover:text-blue-500 flex items-center">
            <ArrowLeftIcon class="text-xl pt-1 mr-3"/> к странице
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

            <div class="flex items-center gap-2 mb-5">
                Компонент: <SelectComponent class="" v-model="form.component_id"/>
            </div>


            <InputBlock label="Порядок" field="order" input-type="number"/>
            <InputBlock label="Классы" field="classes"/>
            <InputBlock label="Внутренние классы" field="inner_classes"/>
            <InputBlock label="Css стили" field="style"/>
            <InputBlock label="отступ сверху" field="pt"/>
            <InputBlock label="отступ снизу" field="pb"/>
            <InputBlock label="Данные" field="datum"/>

            <button type="submit" class="mt-8 btn btn-blue" :disabled="form.processing">Сохранить</button>
        </form>

        <!--  Component Edit  -->
        <ComponentCreateEdit v-if="block?.component" :component="block?.component"/>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
