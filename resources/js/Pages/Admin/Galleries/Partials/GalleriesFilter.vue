<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {onMounted, ref, watch} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import SelectPage from "@/Pages/Admin/Partials/SelectPage.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";


// FILTER
let filterForm = useForm({
    title: '',
    sort_by: 'id',
    page_id: '',
    perPage: '20',
    type: '',
});

let selectedPage = ref();

watch(filterForm, (newValue, oldValue) => {
    if(selectedPage.value !== newValue.page_id){
        selectedPage.value = newValue.page_id;
        submit();
    }
})

let submit = () => {
    filterForm.get(route('galleries.index'), {
        preserveScroll: true,
        preserveState: true,
    });
};

onMounted(() => {
    setQueryArgsToFilterForm();
});

let setQueryArgsToFilterForm = () => {
    // request_all added to HandleInertiaRequests.php
    let fields = router.page.props.ziggy.request_all;

    for(let [field, val] of Object.entries(fields)){
        filterForm[field] = val;
    }

    selectedPage.value = filterForm.page_id;
};
</script>
<template>
    <form @submit.prevent class="flex gap-1 text-sm items-end">
        <LabelInput class="!mb-0" @input="submit" v-model="filterForm.title" placeholder="поиск по имени"/>

        <SelectPage class="w-[220px] h-[26px] overflow-hidden pl-1 pt-0.5 border border-gray-200 rounded" v-model="filterForm.page_id">
            все страницы
        </SelectPage>

        <select class="rounded border-gray-200 text-sm py-0.5 pl-1 pr-7" v-model="filterForm.page_id">
            <option value="">все стр.</option>
            <option value="0">без стр.</option>
        </select>

        <select class="rounded border-gray-200 text-sm py-0.5 text-sm pl-1 pr-7" v-model="filterForm.type" @change="submit">
            <option value="">все типы</option>
            <option value="0">без компонента</option>
            <option v-for="type in $page.props.componentTypes">{{ type }}</option>
        </select>

        <div class="flex flex-col max-w-[185px]">
            <label for="page">показать</label>
            <select class="rounded border-gray-200 text-sm py-0.5 text-sm py-0 pl-1 pr-7" id="page" v-model="filterForm.perPage" @change="submit">
                <option value="10000">все</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <Link :href="route('galleries.index')" class="" title="очистить фильтр">
            <CloseCross class="w-5"/>
        </Link>
    </form>
</template>
