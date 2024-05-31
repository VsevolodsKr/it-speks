<template>
    <Wrapper>
        <div class="flex flex-col items-center">
            <h1 class="font-bold text-3xl text-center text-black dark:text-gray-50">Ielogoties</h1>
            <p class="text-center text-2xl mb-9 text-black dark:text-gray-50">Ieeja administratoriem un moderatoriem</p>
            <form class="max-w-lg" method="post">
                <input type="text" placeholder="Lietotājvārds"
                    class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                <input type="password" placeholder="Parole" v-model="search"
                    class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                <div class="flex justify-center">
                    <CustomButton :title="'Ielogoties'" @click="login" />

                </div>
            </form>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import CustomButton from '../components/CustomButton.vue'
export default {
    components: {
        Wrapper,
        CustomButton,
    },
    methods: {
        login() {
            this.$router.push('/admin');
        }
    }
}
</script>