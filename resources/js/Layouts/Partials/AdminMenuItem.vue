<script setup>
defineProps({routeName:String, title:String})
</script>
<template>
    <Link :href="route(routeName)"
          :class="{ 'bg-gray-700' : $page.props.ziggy.routeName === routeName || (routeName === 'admin' && $page.props.ziggy.routeName === 'pages.edit')}"
          :title="title"
    >
        <slot/>
    </Link>
</template>
