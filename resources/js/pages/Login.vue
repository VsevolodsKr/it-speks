<template>
    <Wrapper>
        <div class="flex flex-col items-center">
            <h1 class="font-bold text-3xl text-center text-black dark:text-gray-50 mb-10">Ielogoties</h1>
            <div
                class="flex flex-col items-center ring-1 ring-gray-300 rounded-xl p-10 dark:bg-zinc-700 shadow-xl bg-white">
                <p class="text-center text-2xl mb-9 text-black dark:text-gray-50">Ieeja administratoriem un moderatoriem
                </p>
                <input type="text" v-model="login_form.username" placeholder="Lietotājvārds"
                    class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                <input type="password" v-model="login_form.password" placeholder="Parole"
                    class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                <div class="flex justify-center">
                    <CustomButton :title="'Ielogoties'" @click="login" />

                </div>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import CustomButton from '../components/CustomButton.vue'
import axios from 'axios';
import { useDark } from '@vueuse/core';
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
export default {
    data: () => {
        return {
            login_form: {
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

            const isDark = useDark();
            const id = toast.loading('Please wait...', { "position": "top-right", "transition": "slide", "theme": (isDark.value ? "dark" : "light") });


            let login_data = new FormData();
            login_data.append('username', this.login_form.username);
            login_data.append('password', this.login_form.password);
            axios.post('/api/login/enter', login_data)
                .then((r) => {
                    const token = r.data;

                    localStorage.setItem('token', token);

                    this.$store.commit("setUser", r.data.data);

                    this.notification(id, 'Logged in successfully!', 'success');

                    setTimeout(() => {
                        this.$router.push('/admin', login_data);
                    }, 1000);


                }).catch((e) => {
                    console.log(e)
                    this.notification(id, e.response.data.message, 'error')
                });
        },
        notification(id, msg, stat) {
            toast.update(id, {
                render: msg,
                autoClose: true,
                closeOnClick: true,
                closeButton: true,
                type: stat,
                "transition": "slide",
                isLoading: false,
            });
            toast.done(id);
        }
    }
}
</script>