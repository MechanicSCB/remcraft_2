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
            <path
                d="M4.828 21l-.02.02-.021-.02H2.992A.993.993 0 0 1 2 20.007V3.993A1 1 0 0 1 2.992 3h18.016c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H4.828zM20 15V5H4v14L14 9l6 6zm0 2.828l-6-6L6.828 19H20v-1.172zM8 11a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"></path>
        </g>
        <title v-if="title">{{ title }}</title>
    </svg>
  </span>
</template>

<script>
export default {
    name: "ImageIcon",
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
