<script setup>
import {inject, onMounted, ref} from "vue";

let form = inject('form');
let props = defineProps({formKeys: Array, fieldName: String})

let formItem = ref(form[props.formKeys[0]]);
onMounted(() => {

});


</script>
<template>
    <input v-model="formItem"
           placeholder=""
    />

</template>
