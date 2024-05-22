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
            news: [
                {
                    id: 0,
                    title: 'Pirmā aktualitāte',
                    desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                },
                {
                    id: 1,
                    title: 'Otrā aktualitāte',
                    desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                },
                {
                    id: 2,
                    title: 'Trešā aktualitāte',
                    desc: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                },
            ]
        }
    },
    components: {
        Wrapper,
        NewsBlock,
    }
}
</script>