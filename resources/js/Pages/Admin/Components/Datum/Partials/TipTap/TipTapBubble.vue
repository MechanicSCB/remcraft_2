<script setup>
import StarterKit from '@tiptap/starter-kit'
import {BubbleMenu, Editor, EditorContent} from '@tiptap/vue-3'
import {Underline} from "@tiptap/extension-underline";
import FormatBoldIcon from "@/Svg/TipTap/FormatBoldIcon.vue";
import FormatItalicIcon from "@/Svg/TipTap/FormatItalicIcon.vue";
import FormatStrikethroughVariantIcon from "@/Svg/TipTap/FormatStrikethroughVariant.vue";
import XmlIcon from "@/Svg/Xml.vue";
import FormatParagraphIcon from "@/Svg/TipTap/FormatParagraph.vue";
import FormatHeader1Icon from "@/Svg/TipTap/FormatHeader1.vue";
import FormatHeader2Icon from "@/Svg/TipTap/FormatHeader2.vue";
import FormatHeader3Icon from "@/Svg/TipTap/FormatHeader3.vue";
import FormatHeader4Icon from "@/Svg/TipTap/FormatHeader4.vue";
import FormatHeader5Icon from "@/Svg/TipTap/FormatHeader5.vue";
import FormatHeader6Icon from "@/Svg/TipTap/FormatHeader6.vue";
import FormatListBulletedIcon from "@/Svg/TipTap/FormatListBulleted.vue";
import FormatListNumberedIcon from "@/Svg/TipTap/FormatListNumbered.vue";
import FormatCodeBlockIcon from "@/Svg/TipTap/FormatCodeBlock.vue";
import FormatQuoteIcon from "@/Svg/TipTap/FormatQuote.vue";
import UndoIcon from "@/Svg/Undo.vue";
import RedoIcon from "@/Svg/Redo.vue";
import MinusIcon from "@/Svg/Minus.vue";
import FormatPageBreakIcon from "@/Svg/TipTap/FormatPageBreak.vue";
import {watch} from "vue";
import TipTapButtons from "@/Pages/Admin/Components/Datum/Partials/TipTap/TipTapButtons.vue";

const props = defineProps({modelValue: String, class: String, iconSize: Number});
const emits = defineEmits(['update:modelValue']);

const editor = new Editor({
    extensions: [
        StarterKit, Underline
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
    <BubbleMenu :editor="editor"
                :tippy-options="{ duration: 100 }"
                v-if="editor"
                class="button-list bg-[rgba(255,255,255,0.9)] flex flex-wrap gap-2 mb-2"
    >
        <TipTapButtons :editor="editor"/>
    </BubbleMenu>

    <EditorContent :editor="editor"/>
</template>
<style>
.button-list button {
    @apply border rounded p-0.5 h-fit bg-white;
}

.button-list button.is-active {
    @apply bg-gray-300;
}
</style>
