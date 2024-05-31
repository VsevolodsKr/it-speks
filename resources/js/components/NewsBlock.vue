<template>
    <div
        class="ring-1 ring-gray-300 p-8 py-10 rounded-xl flex gap-36 flex-wrap w-full text-black dark:text-gray-50 bg-white dark:bg-zinc-700 justify-between shadow-md">
        <!-- col 1 -->
        <div class="flex flex-col justify-between items-start ">
            <div class="">
                <h1 class="font-bold text-4xl mb-8">{{ data.title }}</h1>
                <p class="leading-loose my-5 ">{{ data.short_desc }}</p>
            </div>
            <CustomButton :title="'Lasīt vairāk'"
                @click="this.$router.push('/' + route + '/' + data.id); scrollToTop();" />
        </div>
        <div class="img-cont rounded-xl shadow-md">
            <img class="w-full" :src="data.image_path" alt="">
        </div>
    </div>
</template>

<script>
import CustomButton from './CustomButton.vue'
export default {
    props: ['data', 'route'],
    components: {
        CustomButton,
    },
    mounted() {
        this.data.image_path = new URL(this.data.image_path, import.meta.url);
    },
    methods: {
        scrollToTop() {
            window.scrollTo(0, 0);
        }
    }
}
</script>

<style scoped>
.img-cont {
    width: 24rem;
    max-height: 20rem;
    overflow: hidden;
}
</style>