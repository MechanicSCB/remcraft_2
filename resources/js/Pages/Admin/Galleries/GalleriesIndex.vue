<script setup>
import {router} from "@inertiajs/vue3";
import PencilIcon from "@/Svg/PencilIcon.vue";
import LinkIcon from "@/Svg/BlankLinkIcon.vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {onMounted, ref} from "vue";
import GalleryShow from "@/Pages/Admin/Galleries/GalleryShow.vue";
import GalleriesFilter from "@/Pages/Admin/Galleries/Partials/GalleriesFilter.vue";
import ModalEditGallery from "@/Pages/Admin/Galleries/Partials/ModalEditGallery.vue";
import GalleryImages from "@/Pages/Admin/Galleries/Partials/GalleryImages.vue";
import Pagination from "@/Layouts/Partials/Pagination.vue";

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
        <div class="h-screen pt-[150px]">
            <div class="fixed top-0 z-10">
                <div class="mt-3 flex items-center">
                    <h3 class="text-xl font-bold">Галереи</h3>

                    <ModalEditGallery :gallery="galleries.data[0]">
                        <div class="btn btn-blue text-center">Создать галерею {{ galleries.data[0].slug }}</div>
                    </ModalEditGallery>
                    <Link class="ml-28 my-2 btn btn-blue text-sm" :href="route('galleries.create')">Создать галерею
                    </Link>
                </div>

                <!-- Filtering items -->
                <GalleriesFilter/>

                <!-- Paginator -->
                <Pagination :links="galleries.links" class="mt-3 mb-4"/>
            </div>

            <div class="h-full overflow-y-auto pb-6 pr-3">
                <div v-for="gallery in galleries.data"
                     @click="showedGallery=gallery"
                     class="py-1 flex items-center space-x-4 text-xs hover:bg-blue-100 cursor-pointer"
                     :class="{'bg-blue-200':showedGallery===gallery}"
                >
                    <span>{{ gallery.id }})  {{ gallery.title }} ({{ gallery?.images?.length }}) - {{ gallery.component?.type }}</span>

                    <div class="flex gap-2">
                        <a v-for="block in gallery.component?.blocks"
                           :href="'/' + block.page.slug + '#block_' + block.id"
                           target="_blank"
                           :title="block.page.title"
                        >
                            {{ block.page_id }}
                        </a>
                    </div>

                    <!-- Actions -->
                    <ModalEditGallery :gallery="gallery">
                        <PencilIcon class="w-3.5"/>
                    </ModalEditGallery>

                    <!--<Link :href="route('galleries.edit', gallery.id)" class="hover:text-red-700"><PencilIcon class="w-3.5"/></Link>-->
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
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
