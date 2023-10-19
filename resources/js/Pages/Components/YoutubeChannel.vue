<script setup>
let props = defineProps({datum: Object});
</script>
<template>
    <div class="relative w-full h-[720px] text-white overflow-hidden">
        <!--<div class="flex justify-center items-center h-full">-->
        <!--    &lt;!&ndash; TODO hide adds and controls if vk &ndash;&gt;-->
        <!--    <iframe class="absolute mx-auto z-0 w-[300%] h-full xl:h-[150%]"-->
        <!--            src="https://youtube.com/embed/Vz_TApQvUpk?controls=0&autoplay=1&mute=1&playsinline=1&start=45&loop=1"-->
        <!--    >-->
        <!--    </iframe>-->
        <!--    &lt;!&ndash;<iframe class="absolute mx-auto z-0 w-[300%] h-full xl:h-[150%]"&ndash;&gt;-->
        <!--    &lt;!&ndash;        src="https://vk.com/video_ext.php?oid=-47273267&id=456240082&hash=4b55ae2d18bb724e&autoplay=1&loop=1"&ndash;&gt;-->
        <!--    &lt;!&ndash;&gt;&ndash;&gt;-->
        <!--    &lt;!&ndash;</iframe>&ndash;&gt;-->
        <!--</div>-->
        <video autoplay muted loop class="absolute z-0 w-full h-full object-cover"><source :src="'/video/video_2.webm'" type="video/webm" /></video>

        <div class="z-1 absolute w-full h-full bg-[rgba(0,0,0,0.5)]"></div>

        <div class="top-24 left-0 right-0 z-2 absolute block-container px-2.5 lg:px-0">
            <div class="flex text-base lg:flex-row flex-col">
                <!-- Header -->
                <div class="w-2/3 mb-8">
                    <h2 class="uppercase leading-10">Канал на youtube</h2>
                    <p class="mt-10 w-2/3 mb-6">Канал на котором рассказываем о технологиях и принципах подхода к
                        комплексному ремонту. </p>
                    <a target="_blank" href="https://www.youtube.com/c/REMCRAFT%E2%80%8B/">Перейти на Youtube канал
                        компании</a>
                </div>

                <!--  Links  -->
                <div class="bg-[rgba(0,0,0,0.3)] px-5 py-5 grid grid-cols-1 md:max-lg:grid-cols-2 gap-4">
                    <a href="https://www.youtube.com/watch?v=C92gj-j3Nrs" target="_blank"
                       class="flex space-x-3 hover:opacity-75">
                        <div class="w-40 h-24 shrink-0"
                             style="background: url(/storage/images/youtube-channel/link_1.jpg) center; background-size: cover;">
                        </div>
                        <div class="text-white text-sm h-24 overflow-hidden">
                            Идеальная электрика. Основные принципы качественного электромонтажа.
                        </div>
                    </a>
                    <a href="https://www.youtube.com/watch?v=HZK4hpISP0o" target="_blank"
                       class="flex space-x-3 hover:opacity-75">
                        <div class="w-40 h-24 shrink-0"
                             style="background: url(/storage/images/youtube-channel/link_2.jpg) center; background-size: cover;">
                        </div>
                        <div class="text-white text-sm h-24 overflow-hidden">
                            Ремонт по проекту Земскова + дизайн. Обзор технических решений.
                        </div>
                    </a>
                    <a href="https://www.youtube.com/watch?v=5hPR87w15rE" target="_blank"
                       class="flex space-x-3 hover:opacity-75">
                        <div class="w-40 h-24 shrink-0"
                             style="background: url(/storage/images/youtube-channel/link_3.png) center; background-size: cover;">
                        </div>
                        <div class="text-white text-sm h-24 overflow-hidden">
                            Штукатурка стен механизированным способом. Особенности и технологии.
                        </div>
                    </a>
                    <a href="https://www.youtube.com/watch?v=Vz_TApQvUpk" target="_blank"
                       class="flex space-x-3 hover:opacity-75">
                        <div class="w-40 h-24 shrink-0"
                             style="background: url(/storage/images/youtube-channel/link_4.jpg) center; background-size: cover;">
                        </div>
                        <div class="text-white text-sm h-24 overflow-hidden">
                            Готовый ремонт ЖК Мосфильмовский
                        </div>
                    </a>
                    <a href="https://www.youtube.com/watch?v=NFFezBcdSYg" target="_blank"
                       class="flex space-x-3 hover:opacity-75">
                        <div class="w-40 h-24 shrink-0"
                             style="background: url(/storage/images/youtube-channel/link_5.png) center; background-size: cover;">
                        </div>
                        <div class="text-white text-sm h-24 overflow-hidden">
                            Сантехнический шкаф
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
