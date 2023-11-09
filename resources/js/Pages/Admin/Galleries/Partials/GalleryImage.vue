<script setup>
import {onMounted, ref} from "vue";

let props = defineProps({image: Object, src: String});

let info = ref({});

let imgLoad = (el) => {
    let img = window["img_" + props.image.id];
    info.value = {
        'width': img.naturalWidth,
        'height': img.naturalHeight,
        'weight': GetImageSizeInBytes(props.src),
    };
};

function GetImageSizeInBytes(imgURL) {
    let request = new XMLHttpRequest();
    request.open('HEAD', imgURL, false);
    request.send(null);
    var headerText = request.getAllResponseHeaders();
    var re = /Content\-Length\s*:\s*(\d+)/i;
    re.exec(headerText);

    return parseInt(RegExp.$1);
}
</script>
<template>
    <div class="max-w-[200px] flex flex-col justify-around h-full text-xs">
        <div class="h-full bg-gray-600">
            <img :id="'img_' + image.id"
                 :src="src"
                 alt=""
                 @load="imgLoad($el)"
            >
        </div>
        <div>{{ image.order }} - {{ src.slice(src.lastIndexOf('/') + 1) }} ({{ info.width }} x {{ info.height }}) {{ info.weight / 1000 }}Kb</div>
    </div>
</template>
