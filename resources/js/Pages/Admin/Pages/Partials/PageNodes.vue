<script setup>
import {inject} from "vue";
import ChevronRightIcon from "@/Svg/ChevronRightIcon.vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";
import {ordered} from "@/Stores/Common.js";


let props = defineProps({parent: Object});
let activePage = inject('activePage');
let openedNodes = inject('openedNodes');

function toggle(node) {
    if (openedNodes.value.includes(node.id)) {
        openedNodes.value = openedNodes.value.filter(item => item !== node.id)
    } else {
        openedNodes.value.push(node.id);
    }

    sessionStorage.setItem('openedNodes', JSON.stringify(openedNodes.value))
}
</script>
<template>
    <div class="flex flex-col w-full">
        <div v-for="node in ordered(parent.nodes)" class="">
            <div class="flex gap-1">
                <div class="flex items-center gap-2">
                    <Link v-if="node.page_id"
                          :href="route('pages.edit', node.page_id)"
                          :class="{'text-blue-600':activePage?.id===node.page_id}"
                          class="hover:text-blue-500"
                          draggable="false"
                    >
                        {{ node.order }} - {{ node.title }}
                    </Link>
                    <div v-else class="text-gray-500">{{ node.order }} - {{ node.title }}</div>

                    <div class="fill-blue-500">
                        <ChevronRightIcon @click="toggle(node)"
                                          v-if="Object.keys(node.nodes ?? {}).length && !openedNodes.includes(node.id)"
                                          class="h-6"/>
                        <CollapseIcon @click="toggle(node)"
                                      v-if="Object.keys(node.nodes ?? {}).length && openedNodes.includes(node.id)"
                                      class="w-6"/>
                    </div>
                </div>
            </div>
            <div v-if="openedNodes.includes(node.id)" class="flex">
                <PageNodes class="ml-6" :parent="node"></PageNodes>
            </div>
        </div>
    </div>
</template>

