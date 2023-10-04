<script setup>
defineProps({datum: Object});
</script>
<template>
    <div v-html="datum.body"></div>
</template>
