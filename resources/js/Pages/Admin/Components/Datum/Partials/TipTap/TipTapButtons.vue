<script setup>
import FormatBoldIcon from "@/Svg/TipTap/FormatBoldIcon.vue";
import FormatItalicIcon from "@/Svg/TipTap/FormatItalicIcon.vue";
import FormatStrikethroughVariantIcon from "@/Svg/TipTap/FormatStrikethroughVariant.vue";
import XmlIcon from "@/Svg/Xml.vue";
import FormatParagraphIcon from "@/Svg/TipTap/FormatParagraph.vue";
import FormatHeader1Icon from "@/Svg/TipTap/FormatHeader1.vue";
import FormatHeader2Icon from "@/Svg/TipTap/FormatHeader2.vue";
import FormatHeader3Icon from "@/Svg/TipTap/FormatHeader3.vue";
import FormatListBulletedIcon from "@/Svg/TipTap/FormatListBulleted.vue";
import FormatListNumberedIcon from "@/Svg/TipTap/FormatListNumbered.vue";
import FormatCodeBlockIcon from "@/Svg/TipTap/FormatCodeBlock.vue";
import FormatQuoteIcon from "@/Svg/TipTap/FormatQuote.vue";
import UndoIcon from "@/Svg/Undo.vue";
import RedoIcon from "@/Svg/Redo.vue";
import FormatLinkIcon from "@/Svg/TipTap/FormatLinkIcon.vue";
import FormatLinkOffIcon from "@/Svg/TipTap/FormatLinkOffIcon.vue";
import FormatColorFillIcon from "@/Svg/TipTap/FormatColorFillIcon.vue";
import HorizontalRuleIcon from "@/Svg/TipTap/HorizontalRuleIcon.vue";
import FormatHardBreakIcon from "@/Svg/TipTap/FormatHardBreak.vue";
import ImageIcon from "@/Svg/TipTap/ImageIcon.vue";
import FormatSuperscriptIcon from "@/Svg/TipTap/FormatSuperscriptIcon.vue";
import FormatEraserIcon from "@/Svg/TipTap/FormatEraserIcon.vue";
import FormatUnderlineIcon from "@/Svg/TipTap/FormatUnderlineIcon.vue";

const props = defineProps({editor: Object, iconSize: Number});

let setLink = () => {
    const previousUrl = props.editor.getAttributes('link').href
    const url = window.prompt('URL', previousUrl)

    // cancelled
    if (url === null) {
        return
    }

    // empty
    if (url === '') {
        props.editor
            .chain()
            .focus()
            .extendMarkRange('link')
            .unsetLink()
            .run()

        return
    }

    // update link
    props.editor
        .chain()
        .focus()
        .extendMarkRange('link')
        .setLink({href: url})
        .run()
};

let addImage = () => {
    const url = window.prompt('URL')

    if (url) {
        props.editor.chain().focus().setImage({src: url}).run()
    }
};
</script>

<template>
    <div class="button-list flex flex-wrap gap-1.5">
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
            <FormatHeader1Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
            <FormatHeader2Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
            <FormatHeader3Icon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run()"
                :class="{ 'is-active': editor.isActive('bold') }">
            <FormatBoldIcon :title="editor.isActive('bold') ? 'отменить выделение' : 'выделить'" :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                :class="{ 'is-active': editor.isActive('italic') }">
            <FormatItalicIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleUnderline().run()"
                :disabled="!editor.can().chain().focus().toggleUnderline().run()"
                :class="{ 'is-active': editor.isActive('underline') }">
            <FormatUnderlineIcon :title="editor.isActive('underline') ? 'убрать подчеркивание' : 'подчеркнуть'"
                                 :size="iconSize"/>
        </button>
        <button @click="editor.chain().focus().toggleSuperscript().run()"
                :disabled="!editor.can().chain().focus().toggleSuperscript().run()"
                :class="{ 'is-active': editor.isActive('superscript') }"
        >
            <FormatSuperscriptIcon
                :title="editor.isActive('superscript') ? 'отключить верхний регистр' : 'включить верхний регистр'"
                :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleStrike().run()"
                :disabled="!editor.can().chain().focus().toggleStrike().run()"
                :class="{ 'is-active': editor.isActive('strike') }">
            <FormatStrikethroughVariantIcon :size="iconSize"/>
        </button>
        <button type="button" @click="setLink" :class="{ 'is-active': editor.isActive('link') }">
            <FormatLinkIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().unsetLink().run()" :disabled="!editor.isActive('link')">
            <FormatLinkOffIcon :size="iconSize"/>
        </button>
        <button type="button" @click="addImage">
            <ImageIcon title="вставить изображение" :size="iconSize"/>
        </button>
        <button type="button" class="flex">
            <input type="color"
                   :style="'width: '+ (iconSize ?? 24) +'px;' + 'height: '+ (iconSize ?? 24) +'px;'"
                   @input="editor.chain().focus().setColor($event.target.value).run()"
                   :value="editor.getAttributes('textStyle').color"
            >
        </button>
        <button type="button" @click="editor.chain().focus().unsetColor().run()"
                :class="{ 'is-active': editor.isActive('textStyle')}"
        >
            <FormatColorFillIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleCode().run()"
                :disabled="!editor.can().chain().focus().toggleCode().run()"
                :class="{ 'is-active': editor.isActive('code') }">
            <XmlIcon :size="iconSize"/>
        </button>
        <!-- Clear Nodes and Marks -->
        <button type="button"
                @click="editor.chain().focus().clearNodes().run();editor.chain().focus().unsetAllMarks().run()">
            <FormatEraserIcon title="очистить стили и тэги" :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().setParagraph().run()"
                :class="{ 'is-active': editor.isActive('paragraph') }">
            <FormatParagraphIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'is-active': editor.isActive('bulletList') }">
            <FormatListBulletedIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'is-active': editor.isActive('orderedList') }">
            <FormatListNumberedIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleCodeBlock().run()"
                :class="{ 'is-active': editor.isActive('codeBlock') }">
            <FormatCodeBlockIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'is-active': editor.isActive('blockquote') }">
            <FormatQuoteIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().setHorizontalRule().run()">
            <HorizontalRuleIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().setHardBreak().run()">
            <FormatHardBreakIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run()">
            <UndoIcon :size="iconSize"/>
        </button>
        <button type="button" @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().chain().focus().redo().run()">
            <RedoIcon :size="iconSize"/>
        </button>
    </div>
</template>
<style>
.button-list button {
    @apply border rounded p-0.5 h-fit;
}

.button-list button.is-active {
    @apply bg-gray-300;
}
</style>
