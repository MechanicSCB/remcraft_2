<script setup>
import StarterKit from '@tiptap/starter-kit';
import {BubbleMenu, Editor, EditorContent} from '@tiptap/vue-3'
import {Underline} from "@tiptap/extension-underline";
import {Link} from '@tiptap/extension-link';
import {TextStyle} from "@tiptap/extension-text-style";
import {Color} from '@tiptap/extension-color';
import {Image} from '@tiptap/extension-image';
import {Placeholder} from "@tiptap/extension-placeholder";
import {Superscript} from "@tiptap/extension-superscript";
import {watch} from "vue";
import TipTapButtons from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTapButtons.vue";


const props = defineProps({modelValue: String, class: String, menu: String, iconSize: Number});
const emits = defineEmits(['update:modelValue']);

const editor = new Editor({
    extensions: [
        StarterKit,
        Underline,
        TextStyle,
        Color,
        Image,
        Superscript,
        Placeholder.configure({
            // Use a placeholder:
            placeholder: 'Write something …',
            // Use different placeholders depending on the node type:
            // placeholder: ({ node }) => {
            //   if (node.type.name === 'heading') {
            //     return 'What’s the title?'
            //   }

            //   return 'Can you add some further context?'
            // },
        }),
        Link.configure({
            openOnClick: false,
            HTMLAttributes: {
                rel: null,
                target: null,
            },
        }),
    ],
    content: props.modelValue,
    onUpdate: () => {
        emits('update:modelValue', editor.getHTML())
    },
    editorProps: {
        attributes: {
            class: 'focus:outline-none ' + props.class,
        }
    },
});

watch(() => props.modelValue, (value, oldValue) => {
    if (editor.getHTML() === value) return;

    editor.commands.setContent(value, false)
});
</script>

<template>
    <div class="w-full">
        <TipTapButtons class="mb-2 block-container" v-if="menu==='fixed'" :editor="editor" :icon-size="iconSize"/>
        <BubbleMenu v-else :editor="editor"
                    :tippy-options="{ duration: 100 }"
                    v-if="editor"
                    class="button-list p-1 bg-[rgba(255,255,255,0.95)] flex flex-wrap gap-2 mb-2"
        >
            <TipTapButtons :editor="editor" :icon-size="iconSize"/>
        </BubbleMenu>

        <EditorContent :editor="editor"/>
    </div>
</template>
<style>
.button-list button {
    @apply border rounded p-0.5 h-fit;
}

.button-list button.is-active {
    @apply bg-gray-300;
}

/* Placeholder (at the top) */
.tiptap p.is-editor-empty:first-child::before {
    content: attr(data-placeholder);
    float: left;
    color: #adb5bd;
    pointer-events: none;
    height: 0;
}

/* Placeholder (on every new line) */
/*.tiptap p.is-empty::before {
  content: attr(data-placeholder);
  float: left;
  color: #adb5bd;
  pointer-events: none;
  height: 0;
}*/
</style>
