<template>
    <Wrapper>
        <div class="text-center font-bold text-black dark:text-gray-50">
            <h1 class="text-4xl">Administracijas panelis</h1>
            <h2 class="my-5">Laipni lūgti administracijas panelī, <span class="underline">{{ username
                    }}</span>!</h2>
            <h2>Jūs esat: <span class="underline">{{ role == 1 ? "administrators" : "moderators" }}</span></h2>
        </div>
        <div class="flex justify-evenly flex-wrap gap-3 text-black dark:text-gray-50">
            <h1 :class="[current == 0 ? ' bg-emerald-800 text-white ' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 0">
                Pieteikumi
            </h1>
            <h1 :class="[current == 1 ? ' bg-emerald-800 text-white ' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 1">
                Vakances</h1>
            <h1 :class="[current == 2 ? ' bg-emerald-800 text-white ' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 2">
                Aktualitātes</h1>
            <h1 :class="[current == 3 ? ' bg-emerald-800 text-white ' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
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
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue';
import TableApplications from '../components/TableApplications.vue';
import TableVacancies from '../components/TableVacancies.vue';
import TableNews from '../components/TableNews.vue';
import TableUsers from '../components/TableUsers.vue';
export default {
    data: () => {
        return {
            username: 'user2',
            user: {
                id: 1,
            },
            role: 1,
            current: 0,
            imagename: null,

        }
    },
    components: {
        Wrapper,
        TableApplications,
        TableVacancies,
        TableNews,
        TableUsers
    },

}
</script>