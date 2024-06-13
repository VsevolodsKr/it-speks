<template>
    <Wrapper>
        <div class="flex flex-wrap gap-5">
            <img v-if="current" :src="this.current.image_path"
                class="max-w-96 mr-16 rounded-xl shadow-2xl dark:ring-1 dark:ring-zinc-700">
            <div v-if="current"
                class="bg-white ring-1 max-w-6xl ring-gray-300 rounded-2xl shadow-xl py-10 px-7 dark:bg-zinc-700">

                <div v-if="current" class="mb-5 flex justify-center">
                    <h1 class="font-bold text-3xl text-center bg-calm-green rounded-xl shadow-md p-4 text-gray-50">
                        {{
                            current.title
                        }}</h1>

                </div>
                <p class="text-justify leading-7 indent-16 text-black dark:text-gray-50">{{ current.description }}
                </p>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from "../../components/Wrapper.vue"
export default {
    components: {
        Wrapper,
    },
    data() {
        return {
            current: null,
        }
    },
    async mounted() {
        await axios.get('/api/news/' + this.$route.params.id)
            .then((r) => {
                this.current = r.data;
                this.current.image_path = new URL(this.current.image_path, import.meta.url)
            })
            .catch((e) => {
                console.error(e);
            })
    },
}
</script>