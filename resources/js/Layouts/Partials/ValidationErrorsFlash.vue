<script setup>
import {onUpdated} from "vue";

let props = defineProps({errors:Object})

onUpdated(() => {
    console.log(props.errors)
    setTimeout(() => {
        document.querySelector('div#flash-validation-error').classList.add('fade')
    }, 3000);

    document.querySelector('div#flash-validation-error').classList.remove('fade')
});
</script>

<template>
    <div v-if="Object.keys(errors).length" id="flash-validation-error" class="fixed right-6 bottom-6 z-[100]">
        <div class="bg-red-500 text-white w-fit rounded px-4 py-1 flex flex-col">
            <span v-for="error in errors">{{error}}</span>
        </div>
    </div>
</template>

<style>
.fade {
    opacity: 0;
    transition-property: opacity;
    transition-duration: .25s;
}
</style>
