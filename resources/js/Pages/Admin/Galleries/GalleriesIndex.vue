<script setup>
import {router} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/BlankLinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {ref} from "vue";
import GalleriesFilter from "@/Pages/Admin/Galleries/Partials/GalleriesFilter.vue";
import ModalEditGallery from "@/Pages/Admin/Galleries/Partials/ModalEditGallery.vue";
import GalleryImages from "@/Pages/Admin/Galleries/Partials/GalleryImages.vue";
import Pagination from "@/Layouts/Partials/Pagination.vue";

let props = defineProps({galleries: Object});
let showedGalleryDataId = ref(0);

let deleteGallery = (gallery) => {
    if (confirm('Вы действительно хотите удалить галерею: ' + gallery.title + '?')) {
        router.delete(route('galleries.destroy', gallery));
    }
}
</script>
<template>
    <Head title="Галереи"/>

    <div class="flex h-screen">
        <div class="h-screen pt-[200px]">
            <div class="fixed top-0 z-10">
                <div class="mt-3 flex items-center">
                    <h3 class="text-xl font-bold">Галереи</h3>

                    <Link class="ml-28 my-2 btn btn-blue text-sm" :href="route('galleries.create')">Создать галерею</Link>
                </div>

                <!-- Filtering items -->
                <GalleriesFilter/>

                <!-- Paginator -->
                <Pagination :links="galleries.links" class="mt-4 mb-4"/>
                <div class="text-sm">{{ galleries.to - galleries.from + 1 }} показано с {{ galleries.from }} по {{ galleries.to }} из {{ galleries.total }}</div>

                <!-- Table Header -->
                <div class="w-[550px] flex text-sm font-bold justify-between space-x-4">
                        <div class="w-[350px]">
                            Имя
                        </div>

                        <div class="w-[100px]">
                            страницы
                        </div>

                        <div class="pr-6">дествия</div>
                </div>

            </div>

            <div class="flex h-full">
                <!-- Left -->
                <div class="h-full shrink-0 w-[550px] overflow-y-auto pb-6 pr-3">
                    <div v-for="(gallery, id) in galleries.data"
                         @click="showedGalleryDataId=id"
                         class="py-1 w-full flex items-center justify-between space-x-4 text-xs hover:bg-blue-100 cursor-pointer"
                         :class="{'bg-blue-200':showedGalleryDataId===id}"
                    >
                        <div class="w-[400px]">
                            id:{{ gallery.id }}  {{ gallery.title }} ({{ gallery?.images?.length }}) - {{ gallery.component?.type ?? 'No Component' }}
                        </div>

                        <div class="flex overflow-y-auto gap-2 w-[100px]">
                            <a v-for="block in gallery.component?.blocks"
                               :href="'/' + block.page.slug + '#block_' + block.id"
                               target="_blank"
                               :title="block.page.title"
                            >
                                {{ block.page_id }}
                            </a>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <ModalEditGallery :gallery="gallery">
                                <PencilIcon class="w-3.5"/>
                            </ModalEditGallery>

                            <a :href="route('galleries.show', gallery.id)" class="hover:text-red-700" target="_blank">
                                <LinkIcon class="w-3.5"/>
                            </a>
                            <div @click="deleteGallery(gallery)" class="cursor-pointer hover:text-red-700">
                                <CloseCross class="w-4"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  Right  -->
                <div class="px-4 h-full overflow-y-auto">
                    <div class="mb-2">{{galleries.data[showedGalleryDataId]?.slug}}</div>
                    <GalleryImages :gallery="galleries.data[showedGalleryDataId]"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
