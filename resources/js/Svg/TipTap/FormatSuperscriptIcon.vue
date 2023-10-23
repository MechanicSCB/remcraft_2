<template>
  <span v-bind="$attrs"
        :aria-hidden="!title"
        :aria-label="title"
        class="material-design-icon"
        role="img"
        @click="$emit('click', $event)">
    <svg :fill="fillColor"
         class="material-design-icon__svg"
         :width="size"
         :height="size"
         viewBox="0 0 24 24">
        <path fill="none" d="M0 0h24v24H0z"></path>
        <path d="M5.596 5l4.904 5.928L15.404 5H18l-6.202 7.497L18 19.994V20h-2.59l-4.91-5.934L5.59 20H3v-.006l6.202-7.497L3 5h2.596zM21.55 6.58a.8.8 0 1 0-1.32-.36l-1.155.33A2.001 2.001 0 0 1 21 4a2 2 0 0 1 1.373 3.454L20.744 9H23v1h-4V9l2.55-2.42z"></path>
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
