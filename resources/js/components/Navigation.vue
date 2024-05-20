<template>
    <nav class="font-extralight flex justify-between px-16 py-5 bg-white items-center">
        <div>
            <router-link to="/"><img class="h-12" src="../../images/LOGO.png" alt="it speks logo"></router-link>
        </div>
        <div class="flex gap-12">
            <router-link to="/about">Par mums</router-link>
            <router-link to="/vacancies">Vakances</router-link>
            <router-link to="/news">Aktualitātes</router-link>
            <router-link to="/login">Ielogoties</router-link>
        </div>
    </nav>
</template>

<script>
export default {

}
</script>