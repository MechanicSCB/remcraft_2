<script setup>
import {useForm} from "@inertiajs/vue3";
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";

let props = defineProps({datum: Object});

let form = useForm({
    'name':'',
    'contact':'',
    'desc':'',
    'files':[],
});

let submit = () => {
    form.post(route('bids.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            alert('Спасибо! Ваше сообщение отправлено');
        },
    });
};

</script>
<template>
    <div class="block-container mobile-px">
        <div class="bg-[#f3f2f0] px-4 md:px-10 xl:px-20 py-8">
            <h2>Заявка на расчет стоимости ремонта</h2>

            <form @submit.prevent="submit" class="grid md:grid-cols-2 gap-6">
                <div>
                    <input class="w-full" v-model="form.name" placeholder="Имя" required/>
                    <FormErrorMsg :error-msg="form.errors.name"/>
                </div>
                <div>
                    <input class="w-full" v-model="form.contact" placeholder="Телефон или e-mail" required/>
                    <FormErrorMsg :error-msg="form.errors.email || form.errors.phone"/>
                </div>

                <textarea v-model="form.desc" class="min-h-[100px]" placeholder="Описание проекта"/>

                <button class="bg-blue-500 text-white w-fit h-fit px-16 py-2.5" :disabled="form.processing">Отправить</button>
            </form>
        </div>
    </div>
</template>
<style scoped>
input, textarea
{
    border-color: #ccc;
}
</style>
