<script setup>
defineProps({errorMsg: String});
</script>
<template>
    <div v-if="errorMsg" class="absolute text-red-600 bg-[rgba(255,255,255,0.5)] text-xs pr-4">
        <span>{{ errorMsg }}</span>
    </div>
</template>
