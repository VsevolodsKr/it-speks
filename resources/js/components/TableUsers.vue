<template>
    <div class="flex flex-col items-center gap-8 text-black dark:text-gray-50 ">
        <h3 class="text-center font-bold">Kopā ir {{ users.length }} lietotāji</h3>
        <CustomButton v-if="role == 1" :title="'Pievienot lietotāju'" @click="toggleAdd" />
        <CustomButton v-else :title="'Nomainīt paroli'" @click="togglePass" />
    </div>
    <div class="flex justify-center text-black dark:text-gray-50 ">
        <div class="overflow-x-scroll scroll-pl-6 p-5">
            <table class="ring-1 ring-gray-300 rounded-md  w-max ">
                <tr class="h-12 ring-1 ring-gray-300 rounded-t-md">
                    <th>Lietotājvārds</th>
                </tr>
                <tr v-for="u, index in users" :key="index"
                    :class="[(index == users.length - 1) ? '' : 'border-b-gray-300 border-b-2 border-dashed', 'h-10', user.id == u.id ? (isDark ? 'bg-slate-700' : 'bg-emerald-100') : '']">
                    <td class="text-center border-r-2 border-gray-300 border-dashed px-48">{{ u.username }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed px-5">{{ roles[u.role] }}</td>
                    <td v-if="role == 1" class="text-center border-r-2 border-gray-300 border-dashed p-2">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleEdit(u)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                    </td>
                    <td v-if="role == 1" class="text-center p-2">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleDelete(u)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- hidden DELETE menu -->
    <div v-if="showDelete"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">Nodzēst {{ current.role == 1 ? 'administratoru ' : 'moderatoru ' }} {{
                current.username }}</h1>
            <button @click="toggleDelete" class="text-3xl transition-colors hover:text-emerald-600"><i
                    class="fa-regular fa-circle-xmark"></i></button>
        </div>
        <h3 class="font-bold text-center my-4">Vai Jūs tiešām gribāt nodzēst lietotāju {{ current.username }}?</h3>
        <div class="flex justify-center gap-4 mt-12">
            <CustomButton :title="'Apstiprināt'" :red="true" />
            <CustomButton @click="toggleDelete" :title="'Atcelt'" :gray="true" />
        </div>
    </div>


    <!-- hidden EDIT menu -->
    <div v-if="showEdit"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Rediģēt "{{ current.username }}"</h1>
            <button @click="toggleEdit" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Lietotājvārds</td>
                <td class="p-4">
                    <input type="text" v-model="current.username"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Loma</td>
                <td class="p-4">
                    <select v-model="current.role"
                        class="ring-1 ring-gray-300 w-full py-3 rounded-md px-2 text-black dark:text-gray-50 dark:bg-slate-700">
                        <option v-for="r, i in roles" :key="i" :value="i">{{ r }}</option>
                    </select>
                </td>
            </tr>
            <br class="border-b-2 border-dashed border-gray-300 w-full">
            <tr>
                <td class="font-bold">Vecā parole (atstājiet tukšu, ja nemaināt paroli)</td>
                <td class="p-4">
                    <input type="text" v-model="current.oldpassword"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">

                </td>
            </tr>
            <tr>
                <td class="font-bold">Jaunā parole</td>
                <td class="p-4">
                    <input type="text" v-model="current.newpassword"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" />
    </div>

    <!-- hidden PASSWORD menu -->
    <div v-if="showPass"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Paroles maiņa</h1>
            <button @click="togglePass" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Vecā parole</td>
                <td class="p-4">
                    <input type="text" v-model="edituser.oldpassword"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">

                </td>
            </tr>
            <tr>
                <td class="font-bold">Jaunā parole</td>
                <td class="p-4">
                    <input type="text" v-model="edituser.newpassword"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Jaunā parole atkārtoti</td>
                <td class="p-4">
                    <input type="text" v-model="edituser.newpassword_repeat"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" />
    </div>


    <!-- hidden ADD menu -->
    <div v-if="showAdd"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Pievienot Lietotāju</h1>
            <button @click="toggleAdd" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Lietotājvārds</td>
                <td class="p-4">
                    <input type="text" v-model="new_u.username"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Parole</td>
                <td class="p-4">
                    <textarea v-model="new_u.password"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Loma</td>
                <td class="p-4">
                    <select v-model="new_u.role"
                        class="ring-1 ring-gray-300 w-full py-3 rounded-md px-2 text-black dark:text-gray-50 dark:bg-slate-700">
                        <option v-for="r, i in roles" :key="i" :value="i">{{ r }}</option>
                    </select>
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" />
    </div>
</template>
<script setup>
import { useDark } from '@vueuse/core';
const isDark = useDark();

</script>
<script>
import CustomButton from './CustomButton.vue';
export default {
    props: ['role', 'user'],
    data: () => {
        return {
            users: [
                {
                    id: 0,
                    username: 'user1',
                    role: 0,
                    oldpassword: '',
                    newpassword: '',
                },
                {
                    id: 1,
                    username: 'user2',
                    role: 1,
                    oldpassword: '',
                    newpassword: '',
                },
                {
                    id: 2,
                    username: 'user3',
                    role: 1,
                    oldpassword: '',
                    newpassword: '',
                },
            ],
            roles: [
                'moderators',
                'administrators',
            ],
            current: null,
            new_u: {
                username: '',
                role: '',
                password: '',
            },
            edituser: {
                oldpassword: '',
                newpassword: '',
                newpassword_repeat: '',
            },
            showAdd: false,
            showEdit: false,
            showDelete: false,
            showPass: false,
        }
    },
    components: {
        CustomButton,
    },
    methods: {
        toggleEdit(u) {
            this.showEdit = !this.showEdit
            this.showRead = false
            this.showDelete = false
            this.showPass = false
            this.current = u;
        },
        togglePass(u) {
            this.showPass = !this.showPass
            this.showRead = false
            this.showDelete = false
            this.showEdit = false
        },
        toggleAdd() {
            this.showEdit = false
            this.showRead = false
            this.showDelete = false
            this.showPass = false
            this.showAdd = !this.showAdd
        },
        toggleDelete(u) {
            this.showDelete = !this.showDelete
            this.showRead = false
            this.showEdit = false
            this.showPass = false
            this.current = u;
        }
    }
}
</script>