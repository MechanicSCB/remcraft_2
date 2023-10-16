<script setup>
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";

let props = defineProps({gallery: Object,});

let uploadForm = useForm({
    photos: [],
});


// Upload Photos
let uploadPhotos = () => {
    uploadForm.post(route('images.upload', props.gallery));
    uploadForm.photos = [];
    photos.value = [];
};

const photos = ref([]);
const photoInput = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const addPhotos = () => {
    for(let photo of photoInput.value.files){
        if (!photo) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            uploadForm.photos.push(photo);
            photos.value.push(e.target.result);
        };

        reader.readAsDataURL(photo);
    }
};

const removeFromUpload = (index) => {
    photos.value.splice(index, 1);
    uploadForm.photos.splice(index, 1);
};
</script>
<template>
    <form @submit.prevent="uploadPhotos" class="">
        <div class="">
            <!-- Profile Photo File Input -->
            <input
                ref="photoInput"
                type="file"
                class="hidden"
                accept="image/*"
                @change="addPhotos"
                multiple
            >
            <label for="photo">Фотографии</label>
            <div @click.prevent="selectNewPhoto"
                 class="ml-2 my-2 btn btn-green">Добавить фотографии
            </div>

            <!-- Uploaded Photo Preview -->
            <div class="flex flex-wrap gap-4">
                <div v-for="(photo, index) in photos.slice()"
                     class="relative max-w-[120px] w-full aspect-square bg-cover bg-no-repeat bg-center"
                >
                    <img class="w-full h-full object-cover rounded" :src="photo" alt="">
                    <div class="absolute top-1 right-1 text-3xl font-bold hover:text-red-600 cursor-pointer"
                         @click="removeFromUpload(index)"
                    >
                        <CloseCross class="w-6"/>
                    </div>
                </div>
            </div>
        </div>

        <button v-if="uploadForm.photos.length" type="submit"
                class="mt-6 btn btn-blue"
                :disabled="uploadForm.processing">загрузить
        </button>
    </form>
</template>
