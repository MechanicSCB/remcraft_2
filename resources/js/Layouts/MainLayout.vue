<script setup>
import Header from "@/Layouts/Partials/Header.vue";
import Footer from "@/Layouts/Partials/Footer.vue";
import {onMounted, provide, ref} from "vue";
import MobileMenu from "@/Layouts/Partials/MobileMenu.vue";

let showMobileMenu = ref(false);
let isScrolled = ref(false);
provide('showMobileMenu', showMobileMenu)
provide('isScrolled', isScrolled)

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

let handleScroll = function (event) {
    if (window.scrollY > 50) {
        isScrolled.value = true;
    } else {
        isScrolled.value = false;
    }
}
</script>

<template>
    <div class="">
        <Header/>
        <MobileMenu class="block xl:hidden " v-if="showMobileMenu"/>

        <main class="mt-16 pt-10 min-h-screen main">
            <slot/>
        </main>

        <Footer/>
    </div>
</template>
<style>
.main{
    line-height: 28px;
}

.main a{
    color: #1071ff;
}

.block-container
{
    margin-left:auto;
    margin-right:auto;
    max-width: 1080px;
}

.main h1
{
    font-size: 48px;
}

.main h2
{
    font-size: 36px;
    padding-bottom: 18px;
}

.block-gray{
    background: #f3f2f0;
}

.block-dark
{
    background-color: #313334;
}

@media screen and (max-width: 1280px) {
    .block-container {
        max-width: 840px;
    }
}

@media screen and (max-width: 1024px) {
    .block-container {
        font-size: 14px;
        width: 90%;
        max-width: none;
        line-height: 24px;
    }
    .block-container h1
    {
        font-size: 32px;
    }
    .block-container h2
    {
        font-size: 28px;
    }
}
</style>
