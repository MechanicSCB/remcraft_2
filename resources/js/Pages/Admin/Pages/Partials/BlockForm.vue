<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputBlock from "@/Pages/Admin/Partials/old/InputBlock.vue";
import {provide} from "vue";

let props = defineProps({block: Object,});

let form = useForm({
    pt: props.block.pt,
    order: props.block.order,
    pb: props.block.pb,
    classes: props.block.classes,
    inner_classes: props.block.inner_classes,
    style: props.block.style,
});

provide('form', form);

let submit = () => {
    form.patch(route('blocks.update', props.block));
};
</script>
<template>
    <form @submit.prevent="submit" class="flex">
        <div class="min-h-[120px] flex flex-col justify-between">
            <div>
                <input v-model="form.pt"
                       type="number" step="5" min="0"
                       class="text-sm w-20 py-0 border-gray-200 rounded"
                >

                <InputError :message="form.errors['pt']" class="absolute bg-white"/>
            </div>

            <div>
                <input v-model="form.order"
                       type="number" step="0.5" min="0.5"
                       class="text-sm w-20 py-0 border-gray-200 rounded"
                >

                <InputError :message="form.errors['order']" class="absolute bg-white"/>
            </div>

            <div>
                <input v-model="form.pb"
                       type="number" step="5" min="0"
                       class="text-sm w-20 py-0 border-gray-200 rounded"
                >

                <InputError :message="form.errors['pb']" class="absolute bg-white"/>
            </div>
        </div>
        <div>
            <InputBlock class="mb-2" field="classes" placeholder="внешний"/>
            <InputBlock class="mb-2" field="inner_classes" placeholder="внутренн"/>
            <InputBlock class="mb-2" field="style" placeholder="стили"/>
        </div>

        <button type="submit" class="hidden"></button>
    </form>
</template>
