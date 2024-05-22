<template>
    <nav class="font-extralight flex justify-between px-16 py-5 bg-white items-center">
        <div>
            <router-link to="/"><img class="h-12 min-w-fit" src="../../images/LOGO.png"
                    alt="it speks logo"></router-link>
        </div>
        <button @click="show = !show" class="menu"><i
                :class="[!show ? 'rotate-180' : 'rotate-0', 'fa-regular fa-square-caret-down text-5xl text-emerald-800 hover:text-emerald-600 transition-all navbtn hidden']"></i></button>
        <div class="nava flex gap-12">
            <router-link to="/about">Par mums</router-link>
            <router-link to="/vacancies">Vakances</router-link>
            <router-link to="/news">Aktualitātes</router-link>
            <router-link to="/login">Ielogoties</router-link>
        </div>

    </nav>

    <!-- hidden menu (responsive design) -->
    <div v-if="show"
        class="hidden navb flex flex-col gap-2 bg-white shadow-xl rounded-md w-max p-5 fixed right-2 top-24">
        <router-link to="/about">Par mums</router-link>
        <router-link to="/vacancies">Vakances</router-link>
        <router-link to="/news">Aktualitātes</router-link>
        <router-link to="/login">Ielogoties</router-link>
    </div>
</template>

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