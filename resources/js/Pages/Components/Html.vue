<script setup>
defineProps({datum: Object});
</script>
<template>
    <div class="block-container mobile-px" v-html="datum?.body"></div>
</template>
