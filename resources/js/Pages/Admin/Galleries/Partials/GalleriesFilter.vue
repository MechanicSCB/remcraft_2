<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {onMounted} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";


// FILTER
let filterForm = useForm({
    title: '',
    sort_by: 'id',
    page_id: '',
});

let submit = () => {
    filterForm.get(route('galleries.index'), {
        preserveScroll: true,
        preserveState: true,
    })
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
};
</script>
<template>
    <form @submit.prevent class="flex gap-1 text-sm items-end">
        <div class="flex flex-col">
            <label for="title">Имя</label>
            <input id="title" class="text-sm p-0 w-32" @input="submit" v-model="filterForm.title"/>
        </div>
        <div class="flex flex-col">
            <label for="page">стр.</label>
            <select class="text-sm py-0 pl-1 pr-7" id="page" v-model="filterForm.page_id" @change="submit">
                <option value="">все</option>
                <option value="0">без блока</option>
                <option v-for="page in $page.props.pages" :value="page.id">{{ page.id }} - {{ page.title }}</option>
            </select>
        </div>
        <Link :href="route('galleries.index')" class="" title="очистить фильтр">
            <CloseCross class="w-5"/>
        </Link>
    </form>
</template>
