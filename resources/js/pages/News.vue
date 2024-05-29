<template>
    <Wrapper>
        <h1 class="text-3xl font-bold text-center text-black dark:text-gray-50">Aktualitātes</h1>

        <div class="flex flex-col items-center gap-5">
            <NewsBlock v-for="n in news" :data="n" :route="'news'" />
        </div>
        <!-- num -->
        <h3 class="text-gray-500 text-center font-bold"><span class="underline">{{ news.length
                }}</span><br>aktualitātes
        </h3>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import NewsBlock from '../components/NewsBlock.vue'
export default {
    data: () => {
        return {
            news: [],
        }
    },
    mounted() {
        axios.get('/api/news')
            .then((r) => {
                this.news = r.data;
            })
            .catch((e) => {
                console.error(e);
            })
    },
    components: {
        Wrapper,
        NewsBlock,
    }
}
</script>