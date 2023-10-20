<script setup>
import StarterKit from '@tiptap/starter-kit'
import {Editor, EditorContent} from '@tiptap/vue-3'
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

const props = defineProps({modelValue: String, class:String, iconSize:Number});
const emits = defineEmits(['update:modelValue']);

const editor = new Editor({
    extensions: [
        StarterKit, Underline
    ],
    content: props.modelValue,
    onUpdate: () => {
        emits('update:modelValue', editor.getHTML())
    },
    editorProps:{
        attributes:{
            class:'focus:outline-none ' + props.class,
        }
    },
});

watch(() => props.modelValue, (value, oldValue) => {
    if (editor.getHTML() === value) return;

    editor.commands.setContent(value, false)
});
</script>

<template>
    <div class="button-list flex flex-wrap gap-2 mb-2">
        <button type="button" @click="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
            <FormatBoldIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
            <FormatItalicIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleStrike().run()" :disabled="!editor.can().chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
            <FormatStrikethroughVariantIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleCode().run()" :disabled="!editor.can().chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
            <XmlIcon :size="iconSize"/>
        </button>
        <!--<button type="button" @click="editor.chain().focus().unsetAllMarks().run()">-->
        <!--    clear marks-->
        <!--</button>-->
        <!--<button type="button" @click="editor.chain().focus().clearNodes().run()">-->
        <!--    clear nodes-->
        <!--</button>-->
        <button type="button" @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
            <FormatParagraphIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
            <FormatHeader1Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
            <FormatHeader2Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
            <FormatHeader3Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
            <FormatHeader4Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
            <FormatHeader5Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
            <FormatHeader6Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
            <FormatListBulletedIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
            <FormatListNumberedIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
            <FormatCodeBlockIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
            <FormatQuoteIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().setHorizontalRule().run()">
            <MinusIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().setHardBreak().run()">
            <FormatPageBreakIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()">
            <UndoIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()">
            <RedoIcon :size="iconSize"/>
        </button>
    </div>

    <EditorContent :editor="editor" />
</template>
<style>
.button-list button{
    @apply border rounded p-0.5 h-fit;
}

.button-list button.is-active{
    @apply bg-gray-300;
}
</style>
