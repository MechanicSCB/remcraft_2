<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {onMounted} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";


// FILTER
let filterForm = useForm({
    title: '',
    sort_by: 'id',
    type: '',
    page_id: '',
});

let submit = () => {
    filterForm.get(route('components.index'), {
        preserveScroll: true,
        preserveState: true,
    })
};

onMounted(() => {
    setQueryArgsToFilterForm();
});

let setQueryArgsToFilterForm = () => {
    let uri  = decodeURIComponent(router.page.url).split('?');

    if (uri.length === 2) {
        let vars = uri[1].split('&');
        let tmp = '';

        vars.forEach(function (v) {
            tmp = v.split('=');

            if (tmp.length === 2) {
                if (tmp[0] === 'title') filterForm.title = tmp[1];
                if (tmp[0] === 'sort_by') filterForm.sort_by = tmp[1];
                if (tmp[0].startsWith('type')) filterForm.type=tmp[1];
                if (tmp[0].startsWith('page_id')) filterForm.page_id=tmp[1];
            }
        });
    }
};

//  TODO replace to common shared data
const types = ['Html', 'Masonry', 'Calculator', 'Cost', 'Gallery', 'Pile', 'Recommendation', 'YoutubeChannel'];
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
                <option value="">--</option>
                <option>1</option>
                <option>2</option>
            </select>
        </div>
        <div class="flex flex-col">
            <label for="type">тип</label>
            <select class="text-sm py-0 pl-1 pr-7" id="type" v-model="filterForm.type" @change="submit">
                <option value="">--</option>
                <option v-for="type in types">{{ type }}</option>
            </select>
        </div>
        <Link :href="route('components.index')" class="" title="очистить фильтр">
            <CloseCross/>
        </Link>
    </form>
</template>
