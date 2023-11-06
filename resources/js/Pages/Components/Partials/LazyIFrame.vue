<script setup>
let props = defineProps({src:String});

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
                threshold: 0.0,
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
    <iframe class="w-full h-full"
            src=""
            v-lazyload
            :data-src="src"
    >
    </iframe>
</template>
