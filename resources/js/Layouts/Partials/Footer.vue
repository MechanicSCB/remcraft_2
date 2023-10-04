<script setup>
import Facebook from "@/Svg/Facebook.vue";
import Youtube from "@/Svg/Youtube.vue";
import Instagram from "@/Svg/Instagram.vue";
</script>

<template>
    <div class="pt-12 w-full px-12 bg-gray-50 pb-32">
        <div class="mx-auto max-w-[1080px] flex flex-col md:flex-row md:items-center justify-between space-y-10 ">
            <!-- Logo -->
            <img class="hidden lg:block" src="/img/logo_short.png">

            <!-- Contacts -->
            <div class="flex space-x-6">
                <div>
                    <img src="/img/marker.png" alt="">
                </div>
                <div class="flex flex-col space-y-1">
                    <p>Москва ул. Митинская 12</p>
                    <p>Офис: +7 (985) 740-30-30</p>
                    <p>e-mail: zakaz@remcraft.ru</p>
                </div>
            </div>

            <!-- Social -->
            <div class="flex space-x-6 items-center">
                <Facebook/>
                <Youtube/>
                <Instagram/>
            </div>

            <!--  Right  -->
            <div class="">
                <p><a href="#" class="max-w-[200px] block text-sm underline mb-1.5">Не является публичной офертой</a></p>
                <p>2006 - 2023</p>
            </div>
        </div>
    </div>
</template>
