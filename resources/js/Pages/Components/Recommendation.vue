<script setup>
import LazyImg from "@/Pages/Components/Partials/LazyImg.vue";

let props = defineProps({datum: Object, galleries: Object});

</script>
<template>
    <div class="py-16 px-5 md:px-8 text-white block-container">
        <div class="!px-0 md:px-auto">
            <h2 class="text-4xl">{{ datum.title ?? 'Рекомендуем поcмотреть' }}</h2>

            <!--  ITEMS  -->
            <div class="mt-16 grid md:grid-cols-3 gap-12">
                <Link v-for="(item, id) in datum.items"
                      :href="item.href"
                      class="group"
                >
                    <div class="overflow-hidden max-h-16 md:max-h-full">
                        <LazyImg class="w-full opacity-30 hover:scale-[1.1] bg-white md:min-h-[100px] transition-all duration-300"
                             :src="'/storage/galleries/' + galleries[0]?.slug +'/360x240/' + galleries[0]?.images[id]?.name + '.webp'"
                             :alt="item.text"
                        />
                    </div>
                    <div class="relative -mt-12 md:-mt-8 px-6 text-white text-base group-hover:underline">{{
                            item.text
                        }}
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
