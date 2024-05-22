<template>
    <nav
        class="font-extralight flex justify-between px-16 py-5 dark:bg-slate-700 bg-white items-center fixed top-0 left-0 right-0 shadow-2xl">
        <div>
            <router-link v-if="!isDark" to="/"><img class="h-12 min-w-fit" src="../../images/LOGO.png"
                    alt="it speks logo"></router-link>
            <router-link v-else to="/"><img class="h-12 min-w-fit" src="../../images/LOGO-dark.png"
                    alt="it speks logo"></router-link>
        </div>
        <button @click="show = !show" class="menu"><i
                :class="[!show ? 'rotate-180' : 'rotate-0', 'fa-regular fa-square-caret-down text-5xl dark:text-emerald-400 text-emerald-800 hover:text-emerald-600 transition-all navbtn hidden']"></i></button>
        <div class="nava flex gap-12 items-center text-black dark:text-gray-50">
            <router-link to="/about">Par mums</router-link>
            <router-link to="/vacancies">Vakances</router-link>
            <router-link to="/news">Aktualitātes</router-link>
            <router-link to="/login">Ielogoties</router-link>
            <button><i @click="toggleDark()"
                    :class="[!isDark ? 'fa-solid fa-moon text-indigo-950 hover:text-indigo-500' : 'fa-regular fa-sun text-white hover:text-orange-100', 'text-3xl  ring-1 ring-gray-300 py-2 px-4 rounded-3xl  hover:shadow-xl active:bg-gray-100 transition-all']"></i></button>
        </div>

    </nav>

    <!-- hidden menu (responsive design) -->
    <div v-if="show"
        class="hidden navb flex flex-col gap-2 bg-white shadow-xl rounded-md w-max p-5 fixed right-2 top-24 text-black dark:text-gray-50 dark:bg-slate-700">
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