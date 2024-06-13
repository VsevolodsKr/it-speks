<template>
    <Wrapper>
        <div class="flex justify-center">
            <h1 class="font-bold text-3xl text-center bg-calm-green rounded-xl shadow-md p-4 text-gray-50">Aktualitātes
            </h1>
        </div>
        <div class="flex justify-center">
            <div class="flex flex-col gap-5 max-w-6xl">
                <NewsBlock v-for="n in news" :data="n" :route="'news'" />
            </div>
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