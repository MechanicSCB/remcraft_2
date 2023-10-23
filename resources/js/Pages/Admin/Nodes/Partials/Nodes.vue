<script setup>
import {router} from "@inertiajs/vue3";
import CloseCross from "@/Svg/CloseCross.vue";
import {inject} from "vue";
import PencilIcon from "@/Svg/PencilIcon.vue";
import ChevronRightIcon from "@/Svg/ChevronRightIcon.vue";
import CollapseIcon from "@/Svg/CollapseIcon.vue";
import {ordered} from "@/Stores/Common.js";


let props = defineProps({parent: Object});
let openedNodes = inject('openedNodes');

function dragStart(event, draggedNode) {
    event.dataTransfer.setData("draggedNodeId", draggedNode.id);
    event.dataTransfer.setData("draggedNodeParentPath", draggedNode.parent_path);
    //event.dataTransfer.effectAllowed = 'move'; event.dataTransfer.setDragImage(ev.target,100,100); return true;
}

function dragEnter(event, el) {/* ev.preventDefault(); return true;*/}
function dragOver(event, el) {/* ev.preventDefault();*/}

function dragDrop(event, destNode, mode='move') {
    let draggedNodeId = event.dataTransfer.getData("draggedNodeId");
    let draggedNodeParentPath = event.dataTransfer.getData("draggedNodeParentPath");

    if(draggedNodeId === destNode.id.toString()){
        return;
    }

    if(draggedNodeParentPath === destNode.parent_path && mode==='reorder'){
        router.post(route('nodes.reorder', [draggedNodeId, destNode.id]))
    }else{
        router.post(route('nodes.move', [draggedNodeId, destNode.id]))
    }
}

let deleteNode = (node) => {
    if (confirm('Вы действительно хотите удалить пункт меню: ' + node.title + '?')) {
        router.delete(route('nodes.destroy', node));
    }
}

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
                <div
                     class="cursor-pointer flex items-center gap-2"
                     draggable="true"
                     @dragenter.prevent="dragEnter($event, $el)"
                     @dragover.prevent="dragOver($event, $el)"
                     @drop.prevent="dragDrop($event,node, 'reorder')"
                     @drop.prevent.ctrl="dragDrop($event,node, 'move')"
                     @dragstart="dragStart($event,node)"
                >
                    <div>{{ node.order }} - {{ node.title }}</div>

                    <div class="fill-blue-500">
                        <ChevronRightIcon @click="toggle(node)" v-if="Object.keys(node.nodes ?? {}).length && !openedNodes.includes(node.id)" class="h-6"/>
                        <CollapseIcon @click="toggle(node)" v-if="Object.keys(node.nodes ?? {}).length && openedNodes.includes(node.id)" class="w-6"/>
                    </div>

                    <Link class="mt-1 text-sm flex" :href="route('nodes.edit', node)">
                        <PencilIcon class="w-4"/>
                    </Link>

                    <div @click="deleteNode(node)" class="cursor-pointer hover:text-red-700">
                        <CloseCross class="w-4"/>
                    </div>
                </div>
            </div>
            <div v-if="openedNodes.includes(node.id)" class="flex">
                <Nodes class="ml-6" :parent="node"></Nodes>
            </div>
        </div>
    </div>
</template>

