<template>
    <div class="flex flex-col items-center gap-8 text-black dark:text-gray-50 ">
        <h3 class="text-center font-bold">Kopā ir {{ users.length }} lietotāji</h3>
        <CustomButton v-if="user.data.role == 1" :title="'Pievienot lietotāju'" @click="toggleAdd" />
        <CustomButton :title="'Nomainīt paroli'" @click="togglePass" />
    </div>
    <div class="flex justify-center">
        <div
            class="flex justify-center text-black dark:text-gray-50 ring-1 ring-gray-300 rounded-xl p-10 dark:bg-zinc-700 shadow-xl bg-white w-fit">
            <div class="overflow-x-scroll scroll-pl-6 p-5">
                <table class="ring-1 ring-gray-300 rounded-md  w-max ">
                    <tr class="h-12 ring-1 ring-gray-300 rounded-t-md">
                        <th>Lietotājvārds</th>
                    </tr>
                    <tr v-for="u, index in users" :key="index"
                        :class="[(index == users.length - 1) ? '' : 'border-b-gray-300 border-b-2 border-dashed', 'h-10', user.data.id == u.id ? 'dark:bg-emerald-700 bg-calm-green' : '']">
                        <td class="text-center border-r-2 border-gray-300 border-dashed px-48">{{ u.username }}{{
                            user.id }} </td>
                        <td
                            :class="[user.data.role == 1 ? 'border-r-2 border-gray-300 border-dashed' : '', 'text-center px-5']">
                            {{ roles[u.role] }}</td>
                        <td v-if="user.data.role == 1" class="text-center border-r-2 border-gray-300 border-dashed p-2">
                            <button
                                class="hover:bg-emerald-800 ring-1 ring-gray-300 dark:text-emerald-400 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                                @click="toggleEdit(u)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                        </td>
                        <td v-if="user.data.role == 1" class="text-center p-2">
                            <button
                                class="hover:bg-emerald-800 dark:text-emerald-400 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                                @click="toggleDelete(u)"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- hidden DELETE menu -->
    <Fade>
        <div v-if="showDelete"
            class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 text-black dark:text-gray-50 dark:bg-zinc-700">
            <div class="flex justify-between">
                <h1 class="font-bold text-xl">Nodzēst {{ current.role == 1 ? 'administratoru ' : 'moderatoru ' }} {{
                    current.username }}</h1>
                <button @click="toggleDelete" class="text-3xl transition-colors hover:text-emerald-600"><i
                        class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <h3 class="font-bold text-center my-4">Vai Jūs tiešām gribāt nodzēst lietotāju {{ current.username }}?</h3>
            <div class="flex justify-center gap-4 mt-12">
                <CustomButton @click="deleteUser" :title="'Apstiprināt'" :red="true" />
                <CustomButton @click="toggleDelete" :title="'Atcelt'" :gray="true" />
            </div>
        </div>
    </Fade>


    <!-- hidden EDIT menu -->
    <Fade>
        <div v-if="showEdit"
            class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-zinc-700">
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
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr v-if="user.data.id != current.id">
                    <td class="font-bold">Loma</td>
                    <td class="p-4">
                        <select v-model="current.role"
                            class="ring-1 ring-gray-300 w-full py-3 rounded-md px-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                            <option v-for="r, i in roles" :key="i" :value="i">{{ r }}</option>
                        </select>
                    </td>
                </tr>
                <!-- <br class="border-b-2 border-dashed border-gray-300 w-full"> -->
                <!-- <tr>
                    <td class="font-bold">Vecā parole (atstājiet tukšu, ja nemaināt paroli)</td>
                    <td class="p-4">
                        <input type="text" v-model="current.oldpassword"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr> -->
                <tr v-if="user.data.id != current.id">
                    <td class="font-bold">Jaunā parole</td>
                    <td class="p-4">
                        <input type="text" v-model="current.newpassword"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
            </table>
            <CustomButton :title="'Saglabāt'" @click="editUser" />
        </div>
    </Fade>

    <!-- hidden PASSWORD menu -->
    <Fade>
        <div v-if="showPass"
            class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white dark:bg-zinc-700 text-black dark:text-gray-50 min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen">
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
                        <input type="password" v-model="edituser.oldpassword"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Jaunā parole</td>
                    <td class="p-4">
                        <input type="password" v-model="edituser.newpassword"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Jaunā parole atkārtoti</td>
                    <td class="p-4">
                        <input type="password" v-model="edituser.newpassword_repeat"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
            </table>
            <CustomButton :title="'Saglabāt'" @click="changePassword" />
        </div>
    </Fade>


    <!-- hidden ADD menu -->
    <Fade>
        <div v-if="showAdd"
            class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-zinc-700">
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
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Parole</td>
                    <td class="p-4">
                        <input type="password" v-model="new_u.password"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Loma</td>
                    <td class="p-4">
                        <select v-model="new_u.role"
                            class="ring-1 ring-gray-300 w-full py-3 rounded-md px-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                            <option v-for="r, i in roles" :key="i" :value="i">{{ r }}</option>
                        </select>
                    </td>
                </tr>
            </table>
            <CustomButton :title="'Saglabāt'" @click="add" />
        </div>
    </Fade>
</template>
<script setup>
import { useDark } from '@vueuse/core';
const isDark = useDark();

</script>
<script>
import CustomButton from '../CustomButton.vue';
import { useDark } from '@vueuse/core';
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { mapState } from 'vuex/dist/vuex.cjs.js';
import Fade from '../Fade.vue';
export default {
    props: ['role', 'user'],
    computed: {
        ...mapState(['user']),
    },
    data: () => {
        return {
            users: [],
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
    mounted() {
        this.getUsers()
    },
    components: {
        CustomButton,
        Fade,
    },
    methods: {
        getUsers() {
            axios.get('api/users')
                .then((response) => {
                    this.users = response.data
                })
                .catch((err) => {
                    console.error(err)
                })
        },
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
        },
        add(e) {
            const isDark = useDark();
            const id = toast.loading('Pievienojam lietotāju...', { "position": "bottom-right", "transition": "slide", "theme": (isDark.value ? "dark" : "light") });

            let user_data = new FormData();
            user_data.append('username', this.new_u.username);
            user_data.append('password', this.new_u.password);
            user_data.append('role', this.new_u.role);
            axios.post('/api/users/add', user_data)
                .then((r) => {
                    console.log(r.data)
                    this.getUsers();
                    this.notification(id, 'Lietotājs ir veiksmīgi pieveinots!', 'success');
                })
                .catch((err) => {
                    console.error(err)
                    this.notification(id, e.response.data.message, 'error')
                })
        },
        deleteUser() {
            const isDark = useDark();
            const id = toast.loading('Dzēšam lietotāju...', { "position": "bottom-right", "transition": "slide", "theme": (isDark.value ? "dark" : "light") });

            axios.delete('/api/users/delete/' + this.current.id)
                .then((res) => {
                    console.log(res)
                    this.getUsers()
                    this.toggleDelete(null);
                    this.notification(id, 'Lietotājs ir veiksmīgi nodzēsts!', 'success');
                })
                .catch((err) => {
                    console.error(err)
                    this.notification(id, e.response.data.message, 'error')
                })
        },
        editUser() {
            const isDark = useDark();
            const id = toast.loading('Rediģējam lietotāju...', { "position": "bottom-right", "transition": "slide", "theme": (isDark.value ? "dark" : "light") });
            let user_data = new FormData();
            user_data.append('username', this.current.username);
            user_data.append('role', this.current.role);
            // user_data.append('oldpassword', this.current.oldpassword);
            user_data.append('newpassword', this.current.newpassword);
            axios.post('/api/users/update/' + this.current.id, user_data)
                .then((r) => {
                    console.log(r.data)
                    this.getUsers();
                    this.toggleEdit(null);
                    this.notification(id, 'Lietotājs ir veiksmīgi norediģēts!', 'success');
                })
                .catch((err) => {
                    console.error(err)
                    this.notification(id, e.response.data.message, 'error')
                })
        },
        changePassword() {
            const isDark = useDark();
            const id = toast.loading('Mainām paroli...', { "position": "bottom-right", "transition": "slide", "theme": (isDark.value ? "dark" : "light") });

            let password_data = new FormData();
            password_data.append('oldpassword', this.edituser.oldpassword);
            password_data.append('newpassword', this.edituser.newpassword);
            password_data.append('newpassword_repeat', this.edituser.newpassword_repeat);
            axios.post('/api/users/changePassword/' + this.user.data.id, password_data).then((r) => {
                console.log(r.data);
                this.getUsers();
                this.togglePass(null);
                this.notification(id, 'Parole ir veiksmīgi nomainīta!', 'success');
            }).catch((err) => {
                console.log(err);
                this.notification(id, err.response.data.message, 'error');
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
    },
}
</script>