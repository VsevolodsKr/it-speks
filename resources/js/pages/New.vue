<template>
    <Wrapper>
        <h1 v-if="current" class="font-bold text-3xl text-center text-black dark:text-gray-50">{{ current.title }}</h1>
        <div v-if="current">
            <img :src="this.current.image_path" class="float-left max-w-96 mr-16">
            <p class="text-justify mx-16 leading-7 indent-16 text-black dark:text-gray-50">{{ current.description }}</p>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from "../components/Wrapper.vue"
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