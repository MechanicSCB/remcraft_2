<script setup>
import {ref} from "vue";
import axios from "axios";
import {useForm} from "@inertiajs/vue3";
import CloseCross from "@/Svg/CloseCross.vue";
import LabelInput from "@/Pages/Admin/Partials/LabelInput.vue";

let props = defineProps({galleryId: Number});
let gallery = ref({});
let showModal = ref(false);

let form = useForm({
    title: '',
    slug: '',
    gallery_id: '',
    order: null,
    images: [],
});

let showGalleryModal = () => {
    if (props.galleryId) {
        axios.get('/galleries/' + props.galleryId + '/get-data')
            .catch(error => {
                console.log(error.toJSON());
            })
            .then(response => {
                gallery.value = response.data;
                form.title = gallery.value.title;
                form.slug = gallery.value.slug;
                form.gallery_id = gallery.value.slug;
                form.order = gallery.value.order;
                form.images = gallery.value.images;
                showModal.value = true;
            });
    } else {
        showModal.value = true;
    }
};

let submit = () => {
    if (gallery.value.id) {
        form.put(route('galleries.update', gallery.value.id));
    } else {
        form.post(route('galleries.store'), {
            // onSuccess: () => showModal.value = false,
        });
    }
};
</script>
<template>
    <div>
        <div @click="showGalleryModal" class="cursor-pointer"><slot/></div>

        <div v-if="showModal" @click="showModal=false"
             class="fixed left-0 top-0 w-full h-screen py-2 px-4 bg-[rgba(0,0,0,0.7)] cursor-pointer"
        >
            <div @click.stop class="relative w-full h-full bg-white border p-5 cursor-default overflow-y-auto">
                <!-- Close Modal List Button -->
                <CloseCross @click="showModal=false" class="m-2 w-10 absolute top-0 right-0 cursor-pointer bg-white text-gray-500 hover:text-black"/>

                <form @submit.prevent="submit" class="">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 v-if="gallery.id" class="flex gap-2">Редактировать галерею id:{{ gallery.id }}</h3>
                        <h3 v-else class="flex gap-2">Создать галерею</h3>
                        <button type="submit" class="btn btn-blue" :disabled="form.processing">
                            Сохранить
                        </button>
                    </div>

                    <LabelInput v-model="form.title"
                                placeholder="Введите название галереи"
                                :error-msg="form.errors.title"
                                required
                    >имя</LabelInput>
                </form>
            </div>
        </div>
    </div>
</template>
