<template>
  <span v-bind="$attrs"
        :aria-hidden="!title"
        :aria-label="title"
        class="material-design-icon format-bold-icon"
        role="img"
        @click="$emit('click', $event)">
    <svg :fill="fillColor"
         class="material-design-icon__svg"
         :width="size"
         :height="size"
         viewBox="0 0 24 24">
        <g>
            <path fill="none" d="M0 0h24v24H0z"></path>
            <path d="M8 3v9a4 4 0 1 0 8 0V3h2v9a6 6 0 1 1-12 0V3h2zM4 20h16v2H4v-2z"></path>
        </g>
        <title v-if="title">{{ title }}</title>
    </svg>
  </span>
</template>

<script>
export default {
    emits: ['click'],
    props: {
        title: {
            type: String,
        },
        fillColor: {
            type: String,
            default: "currentColor"
        },
        size: {
            type: Number,
            default: 24
        }
    }
}
</script>
