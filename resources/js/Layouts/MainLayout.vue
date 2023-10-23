<script setup>
import Header from "@/Layouts/Partials/Header.vue";
import Footer from "@/Layouts/Partials/Footer.vue";
import {onMounted, provide, ref} from "vue";
import MobileMenu from "@/Layouts/Partials/MobileMenu.vue";
import Flash from "@/Layouts/Partials/Flash.vue";

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
        <Flash/>

        <Header/>
        <MobileMenu class="block xl:hidden " v-if="showMobileMenu"/>

        <main class="mt-24 min-h-screen main">
            <slot/>
        </main>

        <Footer/>
    </div>
</template>
<style>
.main {
    line-height: 28px;
}

.main a {
    color: #1071ff;
}

.block-container {
    margin-left: auto;
    margin-right: auto;
    max-width: 1080px;
}

.main h1 {
    font-size: 48px;
    line-height: 52px;
    padding-bottom: 24px;
}

.main h2 {
    font-size: 36px;
    padding-bottom: 18px;
    line-height: 40px;
}

.main h3 {
    @apply text-[24px] pb-5;
    line-height: 28px;
}

.main p {
    padding-bottom: 5px;
}

.main ul {
    padding-left: 40px;
    max-width: 785px;
}

.main ol {
    list-style: decimal;
    padding-left: 40px;
    max-width: 785px;
}

.main ol li {
    padding-left: 20px;
}

.main ul li {
    display: flex;
}

.main ul li::before {
    content: "\2022"; /* Add content: \2022 is the CSS Code/unicode for a bullet */
    color: #1071ff; /* Change the color */
    font-weight: bold; /* If you want it to be bold */
    display: inline-block; /* Needed to add space between the bullet and the text */
    width: 1em; /* Also needed for space (tweak if needed) */
    margin-left: -1em; /* Also needed for space (tweak if needed) */
    padding-right: 16px;
}

.main blockquote {
    border-left: 1px solid;
    padding-left: 20px;
}

.block-gray {
    background: #f3f2f0;
}

.block-dark {
    background-color: #313334;
}

.mobile-px {
    @apply px-2.5 lg:px-0;
}

@media screen and (max-width: 1280px) {
    .block-container {
        max-width: 840px;
    }
}

@media screen and (max-width: 1024px) {
    .block-container {
        font-size: 14px;
        max-width: none;
        line-height: 24px;
    }

    .block-container h1 {
        font-size: 32px;
    }

    .block-container h2 {
        font-size: 28px;
    }
}

.main {
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 0;
        overflow: hidden;

        td,
        th {
            min-width: 1em;
            border: 2px solid #ced4da;
            padding: 3px 5px;
            vertical-align: top;
            box-sizing: border-box;
            position: relative;

            > * {
                margin-bottom: 0;
            }
        }

        th {
            font-weight: bold;
            text-align: left;
            background-color: #f1f3f5;
        }

        p {
            margin: 0;
        }
    }
}

</style>
