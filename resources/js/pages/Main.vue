<template>
    <Wrapper>
        <!-- row1 -->
        <div
            class="flex justify-between gap-28 max-[768px]:flex-col md:items-center md:flex-col lg:items-start lg:flex-row text-black dark:text-gray-50">
            <!-- col1 -->
            <div>
                <!-- title -->
                <h1 class="font-bold text-3xl">Laipni lūdzam!</h1>
                <!-- description -->
                <p class="my-5">ac turpis egestas integer eget aliquet nibh praesent tristique magna sit amet purus
                    gravida quis
                    blandit turpis cursus in hac habitasse platea dictumst quisque sagittis purus sit amet volutpat
                    consequat mauris nunc congue nisi vitae suscipit tellus mauris a<br><br>
                    diam maecenas sed enim ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis
                    egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus
                    turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed
                    euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id</p>

                <CustomButton @click="() => { this.$router.push('/vacancies'); scrollToTop(); }"
                    :title="'Apskatīt vakances'"></CustomButton>
            </div>

            <!-- col2 -->
            <div class="flex flex-col items-end font-bold tracking-wide  ">
                <img class="min-[640px]:max-w-7xl " src="../../images/main1.png" alt="welcome image">
                <p>Bildes autors: <a class="underline"
                        href="https://unsplash.com/@olenkasergienko?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Olena
                        Bohovyk</a> no <a class="underline"
                        href="https://unsplash.com/photos/macbook-pro-dIMJWLx1YbE?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
                </p>
            </div>
        </div>

        <!-- row 2 -->
        <div class="text-black dark:text-gray-50">
            <h1 class="font-bold text-3xl text-center">Jaunākas vakances</h1>

            <div class="flex justify-evenly my-8 max-[768px]:flex-col gap-5 md:flex-col items-center 2xl:flex-row">
                <Block v-for="vac in threeVac" :data="vac" :route="'vacancies'" :btnTitle="'Pieteikties'" />
            </div>

            <p class="text-center font-bold">Neder?
                <router-link @click="scrollToTop" to="/vacancies" class="underline text-calm-green font-bold">Apskatīt
                    vairāk</router-link>
            </p>
        </div>

        <!-- row 3 -->
        <div
            class="flex justify-between gap-28 max-[768px]:flex-col md:items-center md:flex-col lg:items-start lg:flex-row ">
            <!-- lcol -->
            <div class="flex flex-col items-start font-bold tracking-wide">
                <img class="min-[640px]:max-w-7xl" src="../../images/main2.png">
                <p>Bildes autors: <a class="underline"
                        href="https://unsplash.com/@clemhlrdt?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Clément
                        Hélardot</a> no <a class="underline"
                        href="https://unsplash.com/photos/black-and-silver-laptop-computer-on-table-95YRwf6CNw8?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
                </p>
            </div>
            <!-- rcol -->
            <div class="text-black dark:text-gray-50">
                <h1 class="font-bold text-3xl">Kas jauns?</h1>
                <p class="my-10">nec sagittis aliquam malesuada bibendum arcu vitae elementum curabitur vitae nunc sed
                    velit dignissim
                    sodales ut eu sem integer vitae justo eget magna fermentum iaculis eu non diam phasellus vestibulum
                    lorem sed risus ultricies tristique nulla aliquet enim tortor at auctor urna nunc id cursus metus
                    aliquam eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque purus
                    semper eget duis at tellus at urna condimentum mattis pellentesque id nibh tortor id aliquet lectus
                    proin nibh nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant morbi
                    tristique senectus et netus et malesuada fames ac turpis egestas sed</p>
                <CustomButton @click="() => { this.$router.push('/news'); scrollToTop(); }"
                    :title="'Apskatīt aktualitātes'" />
            </div>
        </div>

        <!-- row 4 -->
        <div class="text-black dark:text-gray-50">
            <h1 class="font-bold text-3xl text-center">Jaunākas aktualitātes</h1>

            <div class="flex justify-evenly my-8 max-[768px]:flex-col gap-5 md:flex-col items-center 2xl:flex-row">
                <Block v-for="akt in threeAkt" :route="'news'" :data="akt" :btnTitle="'Apskatit'" />
            </div>

            <p class="font-bold text-center">Meklē kaut ko vēl?
                <router-link @click="scrollToTop" to="/news" class="underline text-calm-green font-bold">Apskatīt
                    vairāk</router-link>
            </p>
        </div>

    </Wrapper>
</template>

<script setup>
import { useDark } from '@vueuse/core';
const isDark = useDark();

</script>
<script>

import Wrapper from '../components/Wrapper.vue';
import CustomButton from '../components/CustomButton.vue';
import Block from '../components/Block.vue';

export default {
    data: () => {
        return {
            threeVac: [
                {
                    id: 0,
                    title: 'Pirmā vakance',
                    desc: 'apraksts1',
                },
                {
                    id: 1,
                    title: 'Otrā vakance',
                    desc: 'apraksts2',
                },
                {
                    id: 2,
                    title: 'Trešā vakance',
                    desc: 'apraksts3',
                },
            ],

            threeAkt: [
                {
                    id: 0,
                    title: 'Pirmā aktualitate',
                    desc: 'apraksts1',
                },
                {
                    id: 1,
                    title: 'Otrā aktualitate',
                    desc: 'apraksts2',
                },
                {
                    id: 2,
                    title: 'Trešā aktualitate',
                    desc: 'apraksts3',
                },
            ],
        }
    },
    components: {
        Wrapper,
        CustomButton,
        Block,
    },
    methods: {
        scrollToTop() {
            window.scrollTo(0, 0);
        }
    }
}
</script>