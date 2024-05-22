<template>
    <div
        class="ring-1 ring-gray-200 rounded-xl py-5 px-8 flex flex-col justify-between items-center gap-5 text-black dark:text-gray-50 dark:bg-slate-700 shadow-xl">
        <h1 class="text-2xl font-bold underline">{{ data.title }}</h1>
        <div class="w-96 h-48 overflow-hidden rounded-md">
            <img src="../../images/main2.png">
        </div>
        <p class="italic text-gray-600 dark:text-gray-400">{{ data.desc }}</p>
        <CustomButton :title="btnTitle" @click="this.$router.push('/' + route + '/' + data.id); scrollToTop();" />
    </div>
</template>

<script>
import CustomButton from './CustomButton.vue';
export default {
    props: ['data', 'btnTitle', 'route'],
    //'title', 'desc', 'imgsrc'
    components: {
        CustomButton,
    },
    methods: {
        scrollToTop() {
            window.scrollTo(0, 0);
        }
    }
}
</script>