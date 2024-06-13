<template>
    <Wrapper>
        <div class="flex justify-center">
            <h1 class="font-bold text-3xl text-center bg-calm-green rounded-xl shadow-md p-4 text-gray-50">
                Administracijas panelis</h1>

        </div>
        <div class="flex justify-center">
            <div
                class="text-center font-bold text-black dark:text-gray-50 ring-1 ring-gray-300 rounded-xl p-10 dark:bg-zinc-700 shadow-xl bg-white w-fit">
                <h2 class="mb-5">Laipni lūgti administracijas panelī, <span class="underline">{{ user.data.username
                        }}</span>!
                </h2>
                <h2 class="mb-5">Jūs esat: <span class="underline">{{ user.data.role == 1 ? "administrators" :
                    "moderators" }}</span>
                </h2>
                <CustomButton :title="'Izlogoties'" @click="toggleWarning" />
            </div>
        </div>
        <div class="flex justify-evenly flex-wrap gap-3 text-black dark:text-gray-50">
            <h1 :class="[current == 0 ? ' bg-emerald-800 text-white ' : 'bg-white dark:bg-zinc-700', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100 shadow-md']"
                @click="current = 0">
                Pieteikumi
            </h1>
            <h1 :class="[current == 1 ? ' bg-emerald-800 text-white ' : 'bg-white dark:bg-zinc-700', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100 shadow-md']"
                @click="current = 1">
                Vakances</h1>
            <h1 :class="[current == 2 ? ' bg-emerald-800 text-white ' : 'bg-white dark:bg-zinc-700', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100 shadow-md']"
                @click="current = 2">
                Aktualitātes</h1>
            <h1 :class="[current == 3 ? ' bg-emerald-800 text-white ' : 'bg-white dark:bg-zinc-700', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100 shadow-md']"
                @click="current = 3">
                Lietotāji</h1>
        </div>


        <!-- Pieteikumi -->
        <div v-if="current == 0" class="flex flex-col gap-12">
            <TableApplications />
        </div>
        <!-- Vakances -->
        <div v-if="current == 1" class="flex flex-col gap-12 ">
            <TableVacancies />
        </div>
        <!-- Aktualitates -->
        <div v-if="current == 2" class="flex flex-col gap-12">
            <TableNews />
        </div>
        <!-- Lietotaji -->
        <div v-if="current == 3" class="flex flex-col gap-12">
            <TableUsers :role="role" :user="user" />
        </div>


        <!-- Hidden logout warning -->
        <div
            :class="[showWarning ? 'flex' : 'hidden', 'flex-col justify-between bg-white min-w-96 gap-8 rounded-xl ring-1 ring-gray-300 p-7 text-black dark:text-gray-50 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 shadow-xl dark:bg-zinc-700']">
            <h1 class="font-bold text-xl text-center">Vai Jūs tiešām gribāt izlogoties no Jūsu konta?</h1>
            <div class="grid grid-cols-2 gap-10">
                <CustomButton :title="'Apstiprināt'" :red="true" @click="logout" />
                <CustomButton :title="'Atcelt'" :gray="true" @click="toggleWarning" />
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue';
import TableApplications from '../components/admin_tables/TableApplications.vue';
import TableVacancies from '../components/admin_tables/TableVacancies.vue';
import TableNews from '../components/admin_tables/TableNews.vue';
import TableUsers from '../components/admin_tables/TableUsers.vue';
import { mapState } from 'vuex/dist/vuex.cjs.js';
import CustomButton from '../components/CustomButton.vue';

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useDark } from '@vueuse/core';
export default {
    data: () => {
        return {
            current: 0,
            imagename: null,
            showWarning: false,
        }
    },
    components: {
        Wrapper,
        TableApplications,
        TableVacancies,
        TableNews,
        TableUsers,
        CustomButton,
    },
    computed: {
        ...mapState(['user']),
    },
    methods: {
        logout() {
            this.$store.commit('logout')
            this.$router.push('/login')
        },
        toggleWarning() {
            this.showWarning = !this.showWarning
        }
    }
    // mounted() {
    //     console.log(this.user)
    // }
}
</script>