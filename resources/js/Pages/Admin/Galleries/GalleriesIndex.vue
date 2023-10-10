<script setup>
import {router} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/LinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {onMounted, ref} from "vue";
import GalleryShow from "@/Pages/Admin/Galleries/GalleryShow.vue";
import GalleriesFilter from "@/Pages/Admin/Galleries/Partials/GalleriesFilter.vue";

let props = defineProps({galleries: Object});
let showedGallery = ref(props.galleries[0]);

let deleteGallery = (gallery) => {
    if (confirm('Вы действительно хотите удалить галерею: ' + gallery.title + '?')) {
        router.delete(route('galleries.destroy', gallery));
    }
}
</script>
<template>
    <Head title="Галереи"/>

    <div class="flex h-screen">
        <!-- LEFT -->
        <div class="w-[350px] shrink-0 border-r h-screen">
            <div class="fixed">
                <div class="mt-3 flex items-center">
                    <h3 class="text-xl font-bold">Галереи</h3>

                    <Link class="ml-28 my-2 btn btn-blue text-sm" :href="route('galleries.create')">Создать галерею</Link>
                </div>

                <!-- Filtering items -->
                <GalleriesFilter/>
            </div>

            <div class="pt-28 h-full">
                <div class="h-full overflow-y-auto pb-6">
                    <div v-for="gallery in galleries"
                         @click="showedGallery=gallery"
                         class="py-1 flex items-center space-x-4 text-xs hover:bg-blue-100 cursor-pointer"
                         :class="{'bg-blue-200':showedGallery===gallery}"
                    >
                        <span>{{ gallery.title }} ({{ gallery.images.length }})</span>
                        <Link :href="route('galleries.edit', gallery.id)" class="hover:text-red-700">
                            <PencilIcon class="w-3.5"/>
                        </Link>
                        <a :href="route('galleries.show', gallery.id)" class="hover:text-red-700" target="_blank">
                            <LinkIcon class="w-3.5"/>
                        </a>
                        <div @click="deleteGallery(gallery)" class="cursor-pointer hover:text-red-700">
                            <CloseCross class="w-4"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="main w-full h-full overflow-y-auto">
            <GalleryShow :gallery="showedGallery"/>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}

</script>
