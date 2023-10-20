<script setup>
import {ref, useAttrs} from "vue";

let emits = defineEmits(['update:modelValue']);
let attrs = useAttrs();

emits('update:modelValue', ref({
    'title': attrs.modelValue?.title ?? '',
    'bricks': attrs.modelValue?.bricks ?? [],
}));
</script>
<template>
    <!--<div>modelValue: {{ $attrs.modelValue }}</div>-->
    <div class="masonry-edit">
        <div class="flex items-center gap-6">
            <label class="block mb-2 text-xs" for="title">Заголовок</label>
            <input v-model="$attrs.modelValue['title']"
                   class="text-4xl"
                   id="title"
            />
        </div>

        <div class="mt-4">
            <div v-for="(brick, brickId) in $attrs.modelValue.bricks"
                 class="py-10 px-3 lg:px-16 break-inside-avoid"
                 :class="{'corner':brick.corner}"
            >
                <!-- Corner toggle -->
                <div class="px-1 font-bold float-right text-white text-xs rounded cursor-pointer "
                     :class="$attrs.modelValue.bricks[brickId].corner ? 'bg-red-500' : 'bg-green-500'"
                     @click="$attrs.modelValue.bricks[brickId].corner=!$attrs.modelValue.bricks[brickId].corner">
                    {{ $attrs.modelValue.bricks[brickId].corner ? 'corner ON' : 'corner OFF' }}
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Icon -->
                    <img v-if="brick.icon"
                         class="lg:-ml-16"
                         :src="'/storage/images/masonry-icons/' + brick.icon + '.svg'"
                         :alt="brick.icon">
                    <select v-model="$attrs.modelValue.bricks[brickId].icon" class="w-4 !px-4">
                        <option value="">none</option>
                        <option value="flat_plan">flat_plan</option>
                        <option value="thumbs_up">thumbs_up</option>
                        <option value="gear">gear</option>
                        <option value="monitor">monitor</option>
                        <option value="checklist">checklist</option>
                    </select>

                    <!-- Brick Title -->
                    <input @keydown.enter.prevent
                           class="text-2xl"
                           placeholder="введите заголовок"
                           v-model="$attrs.modelValue.bricks[brickId].title"/>
                </div>

                <!-- Body -->
                <div class="mt-4">
                <textarea v-model="$attrs.modelValue.bricks[brickId].body"
                          class="w-full h-[150px]"
                          placeholder="введите текст элемента"/>
                </div>

                <!-- Links -->
                <div class="mt-5 text-sm flex flex-col gap-1">
                    <div v-for="(link, linkId) in brick.links" class="flex items-center gap-2">
                        <input v-model="$attrs.modelValue.bricks[brickId].links[linkId].text"
                               class="text-sm text-[#2563eb] underline"
                               placeholder="введите текст ссылки"
                               required/>
                        <input v-model="$attrs.modelValue.bricks[brickId].links[linkId].href"
                               class="text-sm text-[#2563eb] underline"
                               placeholder="введите url ссылки"
                               required/>
                        <div @click="$attrs.modelValue.bricks[brickId].links.splice(linkId, 1)"
                             class="px-1.5 pb-0.5 font-bold bg-red-600 text-white rounded-full cursor-pointer">
                            ×
                        </div>
                    </div>
                    <div @click="$attrs.modelValue.bricks[brickId].links.push({'text':'', 'href':''})"
                         class="btn py-0.5"
                    >
                        добавить ссылку
                    </div>
                </div>

                <div class="btn !bg-red-600 text-white" @click="$attrs.modelValue.bricks.splice(brickId, 1)">
                    Удалить элемент
                </div>
            </div>
            <div @click="($attrs.modelValue.bricks ??= []).push({'icon':null,'title':null,'body':null,'bg':null,'links':[]})"
                class="btn"
            >
                Добавить элемент
            </div>
        </div>
    </div>
</template>
<style>
.corner {
    background: url(/storage/images/masonry-icons/corner.png) 100% 0 no-repeat #f3f2f0;
}
.masonry-edit input,
.masonry-edit textarea,
.masonry-edit select
{
    border-color: #eee;
    padding: 0;
}

</style>
