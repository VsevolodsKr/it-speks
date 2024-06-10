<template>
    <nav
        class="font-extralight flex justify-between px-16 py-5 dark:bg-zinc-700 bg-white items-center fixed top-0 left-0 right-0 shadow-2xl z-30">
        <div>
            <router-link to="/"
                class="flex items-center gap-7 hover:ring-1 ring-zinc-300 rounded-md px-5 py-1 transition-all hover:shadow-md dark:text-gray-50">
                <img class=" h-20 min-w-fit" src="../../../images/logo.svg" alt="it speks logo">
                <h1 class="text-3xl tracking-wide">IT Spēks</h1>
            </router-link>
        </div>
        <button @click="show = !show" class="menu"><i
                :class="[!show ? 'rotate-180' : 'rotate-0', 'fa-regular fa-square-caret-down text-5xl dark:text-zinc-300 text-calm-green hover:text-zinc-400 transition-all navbtn hidden dark:hover:text-zinc-500']"></i></button>
        <div class="nava flex items-center text-black dark:text-gray-50">
            <router-link to="/about"
                class="hover:ring-1 ring-zinc-300 rounded-md px-5 py-1 transition-all hover:shadow-md">Par
                mums</router-link>
            <router-link to="/vacancies"
                class="hover:ring-1 ring-zinc-300 rounded-md px-5 py-1 transition-all hover:shadow-md">Vakances</router-link>
            <router-link to="/news"
                class="hover:ring-1 ring-zinc-300 rounded-md px-5 py-1 transition-all hover:shadow-md">Aktualitātes</router-link>
            <router-link to="/login"
                class="hover:ring-1 ring-zinc-300 rounded-md px-5 py-1 transition-all hover:shadow-md">Ielogoties</router-link>
            <button><i @click="toggleDark()"
                    :class="[!isDark ? 'fa-solid fa-moon text-indigo-950 hover:text-indigo-500' : 'fa-regular fa-sun text-white hover:text-orange-100', 'text-3xl  ring-1 ring-gray-300 py-2 px-4 rounded-3xl  hover:shadow-xl ml-6 active:bg-gray-100 transition-all']"></i></button>
        </div>

    </nav>

    <!-- hidden menu (responsive design) -->
    <div v-if="show"
        class="hidden navb flex flex-col gap-2 bg-white shadow-xl rounded-md w-max p-5 fixed right-2 top-36 text-black dark:text-gray-50 dark:bg-zinc-700 z-40">
        <router-link to="/about">Par mums</router-link>
        <router-link to="/vacancies">Vakances</router-link>
        <router-link to="/news">Aktualitātes</router-link>
        <router-link to="/login">Ielogoties</router-link>
        <button><i @click="toggleDark()"
                :class="[!isDark ? 'fa-solid fa-moon text-indigo-950 hover:text-indigo-500' : 'fa-regular fa-sun text-white hover:text-orange-100', 'text-3xl  ring-1 ring-gray-300 py-2 px-4 rounded-3xl  hover:shadow-xl active:bg-gray-100 transition-all']"></i></button>
    </div>
</template>
<script setup>
import { useDark, useToggle } from '@vueuse/core';

const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>
<script>
export default {
    data: () => {
        return {
            show: false,
        }
    },
    methods: {
        showMenu() {
        }
    }
}
</script>

<style scoped>
@media (max-width: 1024px) {
    .nava {
        display: none;
    }

    .navbtn {
        display: block;
    }

    .navb {
        display: flex;
    }
}
</style>