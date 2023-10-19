<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import NodeSelect from "@/Pages/Admin/Partials/NodeSelect.vue";
import PageSelect from "@/Pages/Admin/Partials/PageSelect.vue";

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
    <Head :title="(node ? 'Редактировать' : 'Создать')  + 'пункт меню'"/>

    <div class="">
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">{{ node ? 'Редактировать' : 'Создать' }} пункт меню</h1>

        <form @submit.prevent="submit" class="">
            <div class="">
                <div class="mb-4">
                    <label class="block mb-2 text-sm" for="title">Название пункта меню</label>

                    <input v-model="form.title" class="border border-gray-400 p-2 w-full rounded" type="text"
                           name="title"
                           id="title"
                           placeholder="Введите название пункта меню"
                           required/>
                    <InputError :message="form.errors.title" class="h-0"/>
                </div>

                <!--  Select Parent Menu Item  -->
                <NodeSelect v-model="form.parent_path" class="mb-4"/>

                <!--  Select Page  -->
                <PageSelect v-model="form.page_id" class="mb-4"/>

                <div class="mb-4">
                    <label class="block mb-2 text-sm" for="title">Ссылка</label>

                    <input v-model="form.href" class="border border-gray-400 p-2 w-full rounded" type="text"
                           name="href"
                           id="href"
                           placeholder="Введите адрес ссылки"
                           />
                    <InputError :message="form.errors.href" class="h-0"/>
                </div>


                <button class="btn btn-blue" :disabled="form.processing">Сохранить</button>
            </div>
        </form>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
