<script setup>
import {useForm} from "@inertiajs/vue3";
import FormErrorMsg from "@/Pages/Admin/Partials/FormErrorMsg.vue";
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";

let props = defineProps({datum: Object});
let showModal = ref(false);

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
        <div v-if="datum?.modal===false" class="bg-[#f3f2f0] px-4 md:px-10 xl:px-20 py-8">
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
        <div v-else>
            <!-- Modal show button -->
            <div class="mx-auto bg-blue-500 text-white w-fit h-fit px-6 py-3 cursor-pointer"
                 @click="showModal=true"
                 v-html="datum?.slot ?? 'Оставить&nbsp;заявку'"
            />

            <!-- Modal block -->
            <div v-if="showModal" @click="showModal=false"
                 class="fixed z-50 left-0 top-0 w-full h-screen py-20 px-4 bg-[rgba(0,0,0,0.7)] cursor-pointer"
            >
                <div @click.stop class="relative block-container mobile-px bg-white border py-20 !px-10 cursor-default overflow-y-auto">
                    <!-- Close Modal List Button -->
                    <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                    <form @submit.prevent="submit" class="block-container mobile-px grid md:grid-cols-2 gap-6">
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
        </div>

    </div>
</template>
<style scoped>
input, textarea
{
    border-color: #ccc;
}
</style>
