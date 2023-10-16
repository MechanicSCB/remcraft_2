<script setup>
let props = defineProps({src:String, prev:String});

function getPrev(src){
    return src.replace('/720x480/', '/195x130/');
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
                // Each entry describes an intersection change for one observed
                // target element:
                //   entry.boundingClientRect
                //   entry.intersectionRatio
                //   entry.intersectionRect
                //   entry.isIntersecting
                //   entry.rootBounds
                //   entry.target
                //   entry.time
            });
        }

        function createIntersectionObserver() {
            let options = {
                root: null,
                rootMargin: "0px",
                threshold: 0.7,
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
    <img class="my-lazy w-full h-64"
         :src="getPrev(src)"
         v-lazyload
         :data-src="src"
         alt="random image"
    >
</template>
