<script setup>
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";

let props = defineProps({gallery: Object,});

let form = useForm({
    title: props.gallery?.title ?? '',
    slug: props.gallery?.slug ?? '',
    component_id: props.gallery?.component_id ?? '',
    order: props.gallery?.order ?? '',
    src: props.gallery?.src ?? '',
    images: props.gallery?.images ?? [],
    datum: props.gallery?.datum ?? {},
});

let uploadForm = useForm({
    photos: [],
});

let submit = () => {
    if (props.gallery) {
        form.patch(route('galleries.update', props.gallery));
    } else {
        form.post(route('galleries.store'));
    }
};

let deleteImage = (imageId) => {
    router.delete(route('images.destroy', imageId));
};

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

const addPhoto = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        uploadForm.photos.push(photo);
        photos.value.push(e.target.result);
    };

    reader.readAsDataURL(photo);
};

const removeFromUpload = (index) => {
    index = uploadForm.photos.length - index - 1;
    uploadForm.photos.splice(index, 1);
    photos.value.splice(index, 1);
};

// Drag and Drop Images
function dragStart(event, draggedImgId) {
    event.dataTransfer.setData("draggedImgId", draggedImgId); //event.dataTransfer.effectAllowed = 'move'; event.dataTransfer.setDragImage(ev.target,100,100); return true;
}

function dragEnter(event, el) {/* ev.preventDefault(); return true;*/
}

function dragOver(event, el) {/* ev.preventDefault();*/
}


function dragDrop(event, order) {
    let draggedImgId = event.dataTransfer.getData("draggedImgId");

    console.log(event)
    router.post(route('images.reorder', [draggedImgId, order]));
}

</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>

<template>
    <Head title="Редактировать галерею"/>

    <div class="">
        <div @click="sync">sync</div>
        <!-- Title -->
        <h1 class="mb-3 text-3xl font-bold">Редактировать галерею</h1>

        <!-- Show gallery's images -->
        <div class="flex flex-wrap gap-3">
            <div v-for="image in gallery.images" :key="image.id" class="max-w-[200px]">
                <img :src="'/storage/galleries/' + gallery.slug + '/orig/' + image.n + '.' + image.e"
                     alt=""
                     @drop.prevent="dragDrop($event,image.o)"
                     @dragstart="dragStart($event,image.id)"
                     @dragenter.prevent="dragEnter($event, $el)"
                     @dragover.prevent="dragOver($event, $el)"
                >
                <div @click="deleteImage(image.id)">del</div>
            </div>
        </div>

        <!-- Upload Photos -->
        <form v-if="gallery" @submit.prevent="uploadPhotos" class="">
            <div class="">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    accept="image/*"
                    @change="addPhoto"
                >
                <label for="photo">Фотографии</label>
                <button @click.prevent="selectNewPhoto" type="button"
                        class="mt-2 rounded bg-[#f4f4f4] border border-[#ced4da] py-3 mb-6">Загрузить фотографии
                </button>

                <!-- New Profile Photo Preview -->
                <div class="grid grid-cols-10 gap-4">
                    <div v-for="(photo, index) in photos.slice()"
                         class="relative w-full aspect-square bg-cover bg-no-repeat bg-center"
                    >
                        <img class="w-full h-full object-cover rounded" :src="photo" alt="">
                        <button class="absolute top-1 right-1 text-3xl font-bold opacity-50 hover:opacity-75"
                                type="button" @click="removeFromUpload(index)"
                        >
                            <CloseCross/>
                        </button>
                    </div>
                </div>
            </div>

            <PrimaryButton type="submit"
                           class="mt-12 !block !bg-blue-500 hover:!bg-blue-600 !text-lg normal-case py-2 font-normal !mb-7"
                           :disabled="uploadForm.processing">загрузить
            </PrimaryButton>
        </form>

        <!-- Gallery form ('title', 'slug', 'component_id', ...) -->
        <form @submit.prevent="submit">
            <div class="mb-6">
                <label class="block mb-2 text-sm" for="title">Название галереи</label>

                <input v-model="form.title" class="border border-gray-400 p-2 w-full rounded" type="text"
                       name="title"
                       id="title"
                       placeholder="Введите название галереи"
                       required/>

                <InputError :message="form.errors.title" class="h-0"/>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm" for="slug">slug</label>

                <input v-model="form.slug" class="border border-gray-400 p-2 w-full rounded" type="text"
                       name="slug"
                       id="slug"
                       placeholder="Введите слаг"
                />

                <InputError :message="form.errors.slug" class="h-0"/>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm" for="component_id">Id компонента</label>

                <input v-model="form.component_id" class="border border-gray-400 p-2 w-full rounded" type="text"
                       name="component_id"
                       id="component_id"
                       placeholder="Введите Id компонента"
                />

                <InputError :message="form.errors.component_id" class="h-0"/>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm" for="order">Порядковый номер</label>

                <input v-model="form.order" class="border border-gray-400 p-2 w-full rounded" type="text"
                       name="order"
                       id="order"
                       placeholder="Введите порядковый номер"
                />

                <InputError :message="form.errors.order" class="h-0"/>
            </div>

            <PrimaryButton type="submit"
                           class="mt-12 !block !bg-blue-500 hover:!bg-blue-600 !text-lg normal-case py-2 font-normal !mb-7"
                           :disabled="form.processing">Опубликовать
            </PrimaryButton>
        </form>
    </div>
</template>
