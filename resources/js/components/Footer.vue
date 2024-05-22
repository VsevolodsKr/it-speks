<template>
    <footer
        class="flex justify-center gap-28 md:items-center mt-16 text-gray-500 max-md:flex-col max-md:items-start pl-16">
        <!-- contacts -->
        <div>
            <h1 class="text-3xl tracking-widest font-bold mb-3">Kontakti</h1>
            <div class="flex flex-col gap-4">
                <div class="flex gap-2">
                    <i class="fa-solid fa-phone text-xl"></i>
                    <p class="underline hover:text-lime-600 transition-colors">+371 21234567</p>
                </div>
                <div class="flex gap-2">
                    <i class="fa-solid fa-location-dot text-xl"></i>
                    <p class="underline hover:text-lime-600 transition-colors">Lielā iela 7,Liepāja, Latvija</p>
                </div>
                <div class="flex gap-2">
                    <i class="fa-brands fa-facebook text-xl"></i>
                    <p class="underline hover:text-lime-600 transition-colors">/itspekslv</p>
                </div>
                <div class="flex gap-2">
                    <i class="fa-brands fa-linkedin text-xl"></i>
                    <p class="underline hover:text-lime-600 transition-colors">/itspekslv</p>
                </div>
            </div>
        </div>


        <!-- navigation -->
        <div>
            <div>
                <h1 class="text-3xl tracking-widest font-bold mb-3">Sadaļas</h1>
                <div class="flex flex-col gap-4">
                    <div class="flex gap-2">
                        <i class="fa-solid fa-house text-xl"></i>
                        <router-link to="/" class="underline hover:text-lime-600 transition-colors">Galvena
                            sadaļa</router-link>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-circle-info text-xl"></i>
                        <router-link to="/about" class="underline hover:text-lime-600 transition-colors">Par
                            mums</router-link>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-briefcase text-xl"></i>
                        <router-link to="/vacancies"
                            class="underline hover:text-lime-600 transition-colors">Vakances</router-link>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-newspaper text-xl"></i>
                        <router-link to="/news"
                            class="underline hover:text-lime-600 transition-colors">Aktualitātes</router-link>
                    </div>
                    <div class="flex gap-2">
                        <i class="fa-solid fa-user text-xl"></i>
                        <router-link to="/login"
                            class="underline hover:text-lime-600 transition-colors">Ielogoties</router-link>
                    </div>
                </div>
            </div>
        </div>


        <!-- logo -->
        <div>
            <img v-if="!isDark" class="mt-16" src="../../images/LOGO.png">
            <img v-else class="mt-16" src="../../images/LOGO-dark.png">
            <p class="text-center tracking-widest mt-16">IT Spēks &copy; 2024</p>
        </div>
    </footer>
</template>
<script setup>
import { useDark } from '@vueuse/core';
const isDark = useDark();

</script>
<script></script>