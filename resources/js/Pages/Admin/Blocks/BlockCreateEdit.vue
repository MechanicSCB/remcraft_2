<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {onMounted} from "vue";
import ArrowLeftIcon from "@/Svg/ArrowLeft.vue";
import SelectComponent from "@/Pages/Admin/Partials/SelectComponent.vue";
import SelectPage from "@/Pages/Admin/Partials/SelectPage.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import PencilIcon from "@/Svg/PencilIcon.vue";
import ModalEditComponent from "@/Pages/Admin/Components/Partials/ModalEditComponent.vue";

let props = defineProps({block: Object});

let form = useForm({
    page_id: props.block?.page_id.toString() ?? '',
    component_id: props.block?.component_id.toString() ?? '',
    order: props.block?.order.toString() ?? 999,
    classes: props.block?.classes ?? '',
    inner_classes: props.block?.inner_classes ?? '',
    style: props.block?.style ?? '',
    pt: props.block?.pt.toString() ?? '',
    pb: props.block?.pb.toString() ?? '',
    datum: JSON.stringify(props.block?.datum) ?? '',
});

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
    let fields = router.page.props.ziggy.request_all; // request_all added to HandleInertiaRequests.php

    for (let [field, val] of Object.entries(fields)) {
        form[field] = val;
    }
};

</script>
<template>
    <Head title="Редактировать блок"/>

    <div class="pr-3">
        <!-- Back -->
        <Link v-if="block" :href="route('pages.edit', block.page_id)"
              class="w-fit hover:text-blue-500 flex items-center">
            <ArrowLeftIcon class="text-xl pt-1 mr-3"/>
            к странице
        </Link>

        <!-- Title -->
        <h1 class="mb-3 text-xl font-bold">{{ block ? 'Редактировать' : 'Создать' }} блок</h1>

        <form @submit.prevent="submit" class="">
            <div class="flex items-center gap-2 mb-4">
                Страница:
                <SelectPage v-model="form.page_id" :error-msg="form.errors.page_id">
                    <div class="btn py-0.5">выберите страницу</div>
                </SelectPage>
            </div>

            <div class="flex items-center gap-2 mb-4">
                Компонент:
                <SelectComponent v-model="form.component_id" :error-msg="form.errors.component_id"/>
                <ModalEditComponent v-if="form.component_id" :component-id="form.component_id">
                    <PencilIcon class="w-5"/>
                </ModalEditComponent>
            </div>

            <LabelInput v-model="form.order" :errorMsg="form.errors['order']" type="number" required>
                Порядок
            </LabelInput>
            <div class="flex gap-2">
                <LabelInput v-model="form.classes" :errorMsg="form.errors['classes']" placeholder="введите классы">
                    Классы
                </LabelInput>
                <div>block-dark</div>
            </div>
            <div class="flex gap-2">
                <LabelInput v-model="form.inner_classes" :errorMsg="form.errors['inner_classes']"
                            placeholder="введите классы">Внутренние классы
                </LabelInput>
                <!-- TODO ref to buttons or select or dataset -->
                <div>block-container mobile-px</div>
            </div>

            <LabelInput v-model="form.style" placeholder="введите Css стили">Css стили</LabelInput>
            <LabelInput v-model="form.pt" :errorMsg="form.errors['pt']" type="number">отступ сверху</LabelInput>
            <LabelInput v-model="form.pb" :errorMsg="form.errors['pb']" type="number">отступ снизу</LabelInput>
            <div class="flex gap-2">
                <LabelInput v-model="form.datum" :errorMsg="form.errors['datum']"
                            placeholder='{"format":"json string"}'>Данные
                </LabelInput>
                <div>{"type":"mosaic"}</div>
            </div>


            <button type="submit" class="mt-8 btn btn-blue" :disabled="form.processing">Сохранить</button>
        </form>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
