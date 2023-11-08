<script setup>
import {useForm} from "@inertiajs/vue3";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";
import SelectPage from "@/Pages/Admin/Partials/SelectPage.vue";
import SelectNode from "@/Pages/Admin/Partials/SelectNode.vue";

let props = defineProps({node:Object});

let form = useForm({
    title: props.node?.title ?? '',
    page_id: props.node?.page_id ?? '',
    parent_path: props.node?.parent_path ?? '1',
    order: props.node?.order ?? '',
    href: props.node?.href ?? '',
});

let submit = () => {
    if(props.node){
        form.put(route('nodes.update', props.node.id));
    }else {
        form.post(route('nodes.store'));
    }
};
</script>
<template>
    <Head :title="(node ? 'Редактировать' : 'Создать')  + ' пункт меню'"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">{{ node ? 'Редактировать' : 'Создать' }} пункт меню</h1>

        <form @submit.prevent="submit" class="">
            <LabelInput input-class="w-[350px]" v-model="form.title" :error-msg="form.errors.title" name="nodeTitle">Название пункта меню</LabelInput>

            <!--  Select Parent Menu Node  -->
            <SelectNode v-model="form.parent_path" class="mb-4"/>

            <!--  Select Page  -->
            <SelectPage v-model="form.page_id" class="mb-4">
                <div class="btn py-0.5">выберите страницу</div>
            </SelectPage>

            <LabelInput v-model="form.href" :error-msg="form.errors.href" name="nodeHref">Ссылка</LabelInput>

            <button class="btn btn-blue" :disabled="form.processing">Сохранить</button>
        </form>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
