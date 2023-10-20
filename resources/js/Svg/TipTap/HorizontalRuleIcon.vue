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
      <path fill="none" d="M0 0h24v24H0z"></path>
        <path d="M2 11h2v2H2v-2zm4 0h12v2H6v-2zm14 0h2v2h-2v-2z"></path>
        <title v-if="title">{{ title }}</title>
    </svg>
  </span>
</template>

<script>
export default {
    name: "HorizontalRuleIcon",
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
