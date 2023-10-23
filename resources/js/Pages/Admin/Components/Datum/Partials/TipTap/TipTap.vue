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
import {onBeforeUnmount, ref, useAttrs, watch} from "vue";
import TipTapButtons from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTapButtons.vue";
import {Table} from "@tiptap/extension-table";
import {Gapcursor} from "@tiptap/extension-gapcursor";
import {TableRow} from "@tiptap/extension-table-row";
import {TableHeader} from "@tiptap/extension-table-header";
import {TableCell} from "@tiptap/extension-table-cell";
import {TextAlign} from "@tiptap/extension-text-align";
import {InvisibleCharacters} from "@tiptap-pro/extension-invisible-characters";


const props = defineProps({modelValue: String, class: String, menu: String, iconSize: Number, noFix:Boolean, noAir:Boolean});
const emits = defineEmits(['update:modelValue']);
let attrs = useAttrs();
let showRawHtml = ref(false);
let rawHtml = ref(props.modelValue);

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
            placeholder: attrs.placeholder ?? 'Введите текст...',
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
        Gapcursor,
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
        Table.configure({
            resizable: true,
            HTMLAttributes: {
                style: 'max-width:750px;',
            },
        }),
        TableRow,
        TableHeader,
        TableCell,
        InvisibleCharacters,
    ],
    content: props.modelValue,
    onUpdate: () => {
        emits('update:modelValue', editor.getHTML());
        rawHtml.value = editor.getHTML();
    },
    editorProps: {
        attributes: {
            class: 'focus:outline-none ' + props.class,
        }
    },
});

watch(() => rawHtml.value, (value, oldValue) => {
    if (props.modelValue === value) return;

    emits('update:modelValue', value);
    editor.commands.setContent(value, false)
});

onBeforeUnmount(() => {
    editor.destroy();
});

// watch(() => props.modelValue, (value, oldValue) => if (rawHtml.value !== value) rawHtml.value = value;);
</script>

<template>
    <div>
        <div @click="showRawHtml=!showRawHtml" class="btn mb-2 text-sm" >
            {{ showRawHtml ? 'включить редактор' : 'показать код' }}
        </div>

        <textarea v-if="showRawHtml" class="min-h-[120px] w-full" v-model="rawHtml"></textarea>

        <div v-else class="">
            <TipTapButtons v-if="editor && ! noFix"
                           class="mb-2"
                           :editor="editor"
                           :icon-size="iconSize"
            />
            <BubbleMenu v-if="editor && ! noAir"
                        :editor="editor"
                        :tippy-options="{ duration: 100 }"
                        class="button-list p-1 bg-[rgba(255,255,255,0.95)] flex flex-wrap gap-2 mb-2"
            >
                <TipTapButtons :editor="editor" :icon-size="iconSize"/>
            </BubbleMenu>

            <EditorContent :editor="editor"/>
        </div>
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

.tiptap table .selectedCell:after {
    z-index: 2;
    position: absolute;
    content: "";
    left: 0; right: 0; top: 0; bottom: 0;
    background: rgba(200, 200, 255, 0.4);
    pointer-events: none;
}

.tiptap table .column-resize-handle {
    position: absolute;
    right: -2px;
    top: 0;
    bottom: -2px;
    width: 4px;
    background-color: #adf;
    pointer-events: none;
}

.tableWrapper {
    padding: 1rem 0;
    overflow-x: auto;
}

.resize-cursor {
    cursor: ew-resize;
    cursor: col-resize;
}
</style>
