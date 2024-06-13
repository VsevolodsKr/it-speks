<template>
    <div
        class="ring-1 ring-gray-200 rounded-xl py-5 px-8 flex flex-col justify-between items-center gap-5 text-black dark:text-gray-50 bg-white dark:bg-zinc-700 shadow-2xl max-w-md hover:ring-2 transition-all ">
        <!-- <h1 class="text-2xl font-bold underline">{{ data.title }}</h1> -->
        <div class="flex justify-center">
            <h1 class="font-bold text-xl text-center bg-calm-green rounded-xl shadow-md p-4 text-gray-50">
                {{ data.title }}</h1>
        </div>
        <div class="min-[600px]:w-96 min-w-48 h-48 overflow-hidden rounded-md relative shadow-2xl ">
            <img :src="data.image_path" class="-translate-y-1/2 absolute top-1/2">
        </div>
        <p class="italic text-gray-600 dark:text-gray-400 w-full break-words">{{ truncateDescription(data.description)
            }}
        </p>
        <CustomButton :title="btnTitle" @click="this.$router.push('/' + route + '/' + data.id); scrollToTop();" />
    </div>
</template>

<script>
import { data } from 'autoprefixer';
import CustomButton from './CustomButton.vue';
export default {
    props: ['data', 'btnTitle', 'route'],
    components: {
        CustomButton,
    },
    mounted() {
        this.data.image_path = new URL(this.data.image_path, import.meta.url);

    },
    methods: {
        scrollToTop() {
            window.scrollTo(0, 0);
        },
        truncateDescription(description) {
            const limit = 99;
            return description.length > limit ? description.substring(0, limit) + '...' : description;
        }
    }
}
</script>