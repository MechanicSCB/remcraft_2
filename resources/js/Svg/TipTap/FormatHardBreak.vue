<template>
  <span v-bind="$attrs"
        :aria-hidden="!title"
        :aria-label="title"
        class="material-design-icon format-page-break-icon"
        role="img"
        @click="$emit('click', $event)">
    <svg :fill="fillColor"
         class="material-design-icon__svg"
         :width="size"
         :height="size"
         viewBox="0 0 24 24">
        <g>
            <path fill="none" d="M0 0h24v24H0z"></path>
            <path
                d="M15 18h1.5a2.5 2.5 0 1 0 0-5H3v-2h13.5a4.5 4.5 0 1 1 0 9H15v2l-4-3 4-3v2zM3 4h18v2H3V4zm6 14v2H3v-2h6z"></path>
        </g>
    </svg>
  </span>
</template>

<script>
export default {
  name: "FormatHardBreakIcon",
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
