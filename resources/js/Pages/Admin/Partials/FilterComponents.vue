<template>
    <div>
        <!-- Search in title -->
        <input ref="search"
               v-model="$attrs.modelValue.search"
               type="text"
               placeholder="поиск по имени"
               class="py-0.5 border-gray-200"
        >

        <!-- Select Page -->
        <select v-model="$attrs.modelValue.page_id" class="py-0.5 border-gray-200">
            <option :value="null">все страницы</option>
            <option :value="-1">непривязанные</option>
            <option v-for="page in $page.props.pages" :value="page.id">
                {{ page.id }} - {{ page.title }}
            </option>
        </select>

        <!-- Select Type -->
        <select v-model="$attrs.modelValue.type" class="py-0.5 border-gray-200">
            <option :value="null">все типы</option>
            <option v-for="type in $page.props.componentTypes">{{ type }}</option>
        </select>
    </div>
</template>
