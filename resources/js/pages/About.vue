<template>
    <Wrapper>
        <div class="flex justify-center">
            <div
                class="bg-white max-w-7xl flex justify-evenly gap-28 max-md:flex-col text-black dark:text-gray-50 lg:flex-row items-center ring-1 ring-zinc-300 w-fit py-10 min-[710px]:px-28 max-[710px]:px-4 rounded-xl shadow-xl dark:bg-zinc-700 transition-all">
                <div
                    class="a flex justify-between gap-28 max-md:flex-col lg:flex-row items-center text-black dark:text-gray-50 max-w-7xl">
                    <div>
                        <div class="flex">
                            <h1
                                class="font-bold text-3xl text-center bg-calm-green rounded-xl shadow-md p-4 text-gray-50">
                                Par mums</h1>

                        </div>
                        <p class="my-5">ac turpis egestas integer eget aliquet nibh praesent tristique magna sit amet
                            purus
                            gravida quis blandit turpis cursus in hac habitasse platea dictumst quisque sagittis purus
                            sit
                            amet
                            volutpat consequat mauris nunc congue nisi vitae suscipit tellus mauris a<br><br> diam
                            maecenas
                            sed
                            enim ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas
                            pretium
                            aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis
                            massa
                            tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod
                            nisi
                            porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id</p>
                    </div>
                    <div class="flex flex-col justify-center font-bold tracking-wide">
                        <img class="max-w-72" src="../../images/logo.svg">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center ">
            <div
                class="a transition-all bg-white max-w-7xl flex justify-evenly flex-wrap gap-32 max-md:flex-col text-black dark:text-gray-50 lg:flex-row items-center ring-1 ring-zinc-300 w-fit py-10 min-[786px]:px-20 max-[786px]:px-4 rounded-xl shadow-xl  dark:bg-zinc-700">
                <div class="flex flex-col gap-12 justify-center max-w-96">
                    <h1 class="font-bold text-3xl text-black dark:text-gray-50">Kontakti</h1>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-phone text-2xl"></i>
                        <p class="text-xl">Tālrunis: +371 21234567</p>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-location-dot text-2xl"></i>
                        <p class="text-xl">Adrese: Lielā iela 7, Liepāja, Latvija</p>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-brands fa-facebook text-2xl"></i>
                        <p class="text-xl">/itspekslv</p>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-brands fa-linkedin text-2xl"></i>
                        <p class="text-xl">/itspekslv</p>
                    </div>
                </div>
                <div class="flex flex-col justify-center font-bold tracking-wide">
                    <iframe class="shadow-xl rounded-xl transition-all"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d35217.26690304116!2d20.988979250802508!3d56.51806510102045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa617645b26f7%3A0x5040b214d6234e8c!2zTGllbMSBIGllbGEgNywgTGllcMSBamEsIExWLTM0MDE!5e0!3m2!1sru!2slv!4v1715712495817!5m2!1sru!2slv"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import CustomButton from '../components/CustomButton.vue'
export default {
    components: {
        Wrapper,
        CustomButton,
    }
}
</script>
<script setup>
import { useDark } from '@vueuse/core';
const isDark = useDark();

</script>

<style scoped>
@media(max-width:790px) {
    iframe {
        width: 25rem;
    }
}

@media(max-width:900px) {
    iframe {
        width: 30rem;
    }
}

@media(max-width:625px) {
    iframe {
        width: 18rem;
    }
}

@media(max-width:990px) {
    .a {
        flex-direction: column;
    }
}
</style>