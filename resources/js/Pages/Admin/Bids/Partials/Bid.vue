<script setup>
import {router, useForm} from "@inertiajs/vue3";
import CloseCross from "@/Svg/CloseCross.vue";

let props = defineProps({bid: Object})
let form = useForm({
    status: props.bid.status,
    comment: props.bid.comment,
});

let submit = () => {
    form.put(route('bids.update', props.bid));
};

let deleteBid = () => {
    if (confirm('Вы действительно хотите удалить заявку: ' + props.bid.id + '?')) {
        router.delete(route('bids.destroy', props.bid));
    }
}
</script>
<template>
    <form @submit.prevent="submit">
        <div>{{ bid.id }} - {{ bid.name }} - {{ bid.contact }} - {{ bid.created_at }} - {{ bid.updated_at }}</div>
        <div class="mt-3">{{ bid.desc }}</div>
        <select v-model="form.status"
                @change="submit"
                class="mt-4 border-gray-200 text-white"
                :class="form.status==='не рассмотрена' ? 'bg-red-500' : 'bg-yellow-500'"
        >
            <option>не рассмотрена</option>
            <option>рассмотрена</option>
        </select>
        <input v-model="form.comment"
               placeholder="комментарий сотрудника"
               class="border-gray-200"
        />
        <div @click="deleteBid(bid)" class="absolute right-1 top-1 cursor-pointer hover:text-red-700">
            <CloseCross class="w-6"/>
        </div>
    </form>
</template>
