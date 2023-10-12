<script setup>
let props = defineProps({src:String, prev:String});

function getPrev(src){
    return src.replace('/w720/', '/w200/');
}

const vLazyload = {
    mounted: (el) => {
        function loadImage(){
            el.src = el.dataset.src
        }

        function callback(entries, observer){
            entries.forEach((entry) => {
                if(entry.isIntersecting){
                    loadImage();
                    observer.unobserve(el);
                }
            });
        }

        function createIntersectionObserver() {
            let options = {
                root: null,
                rootMargin: "0px",
                threshold: 0.1,
            };

            let observer = new IntersectionObserver(callback, options);
            observer.observe(el);
        }

        if(! window['IntersectionObserver']){
            loadImage();
        }else{
            createIntersectionObserver();
        }
    },
}
</script>
<template>
    <img class="my-lazy w-full h-full"
         :src="getPrev(src)"
         v-lazyload
         :data-src="src"
         alt="random image"
    >
</template>
