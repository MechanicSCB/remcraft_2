<script setup>
import BlockShow from "@/Pages/Pages/Partials/BlockShow.vue";

defineProps({block: Object});
</script>
<template>
    <div class="px-2">
        <BlockShow :block="block"/>
    </div>
</template>
