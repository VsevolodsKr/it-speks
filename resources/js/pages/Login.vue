<template>
    <Wrapper>
        <div class="flex flex-col items-center">
            <h1 class="font-bold text-3xl text-center text-black dark:text-gray-50 mb-10">Ielogoties</h1>
            <div
                class="flex flex-col items-center ring-1 ring-gray-300 rounded-xl p-10 dark:bg-zinc-700 shadow-xl bg-white">
                <p class="text-center text-2xl mb-9 text-black dark:text-gray-50">Ieeja administratoriem un moderatoriem
                </p>
                <form class="max-w-lg" method="post">
                    <input type="text" v-model="login.username" placeholder="Lietotājvārds"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                    <input type="password" v-model="login.password" placeholder="Parole"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                    <div class="flex justify-center">
                        <CustomButton :title="'Ielogoties'" @click="login" />

                    </div>
                </form>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import CustomButton from '../components/CustomButton.vue'
import axios from 'axios';
export default {
    data: () => {
        return{
            login: {
                username: '',
                password: '',
            }
        }
    },
    components: {
        Wrapper,
        CustomButton,
    },
    methods: {
        login() {
            let login_data = new FormData();
            login_data.append('username', this.login.username);
            login_data.append('password', this.login.password);
            axios.post('/api/login/enter', login_data);
        }
    }
}
</script>