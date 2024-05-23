<template>
    <div class="flex flex-col items-center gap-8 text-black dark:text-gray-50 ">
        <h3 class="text-center font-bold">Kopā ir {{ vacancies.length }} vakances</h3>
        <CustomButton :title="'Pievienot vakanci'" @click="toggleAdd" />
    </div>
    <div class="flex justify-center text-black dark:text-gray-50 ">
        <div class="overflow-x-scroll scroll-pl-6 p-5">
            <table class="ring-1 ring-gray-300 rounded-md  w-max ">
                <tr class="h-12 ring-1 ring-gray-300 rounded-t-md ">
                    <th></th>
                    <th class="px-5">Nosaukums</th>
                    <th class="px-10">Uzņēmums</th>
                    <th>Slodze</th>
                    <th>Atalgojums</th>
                    <th>Vieta</th>
                    <th>Kontakti</th>
                    <th>Apraksts</th>
                </tr>
                <tr v-for="v, index in vacancies" :key="index"
                    :class="[(index == vacancies.length - 1) ? '' : 'border-b-gray-300 border-b-2 border-dashed ', 'h-10']">
                    <td class="p-9 text-center border-r-2 border-gray-300 border-dashed "><img :src="v.image"
                            class="max-w-64 rounded-md"></td>
                    <td class="px-16 text-center border-r-2 border-gray-300 border-dashed ">{{ v.title }}</td>
                    <td class="px-16 text-center border-r-2 border-gray-300 border-dashed">{{ v.company }}</td>
                    <td class="px-10 text-center border-r-2 border-gray-300 border-dashed">{{ v.time }}</td>
                    <td class="px-16 text-center border-r-2 border-gray-300 border-dashed">{{ v.salary }}</td>
                    <td class="px-16 text-center border-r-2 border-gray-300 border-dashed">{{ v.location }}</td>
                    <td class="px-16 text-center border-r-2 border-gray-300 border-dashed">{{ v.contacts }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleRead(v)"><i class="fa-solid fa-book-open"></i></button>
                    </td>
                    <td class="text-center px-5">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleEdit(v)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- hidden READ menu -->
    <div v-if="showRead"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">{{ current.title }}</h1>
            <button @click="toggleRead" class="text-3xl transition-colors hover:text-emerald-600"><i
                    class="fa-regular fa-circle-xmark"></i></button>
        </div>
        <p>{{ current.info }}</p>
    </div>


    <!-- hidden EDIT menu -->
    <div v-if="showEdit"
        class="text-black dark:text-gray-50 dark:bg-slate-700 ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Rediģēt "{{ current.title }}"</h1>
            <button @click="toggleEdit" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Nosaukums</td>
                <td class="p-4">
                    <input type="text" v-model="current.title"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Bilde</td>
                <td class="p-4">
                    <input type="text" v-model="current.image"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Uzņēmums</td>
                <td class="p-4">
                    <input type="text" v-model="current.company"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Slodze</td>
                <td class="p-4">
                    <input type="text" v-model="current.time"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Atalgojums</td>
                <td class="p-4">
                    <input type="text" v-model="current.salary"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Vieta</td>
                <td class="p-4">
                    <input type="text" v-model="current.location"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Kontakti</td>
                <td class="p-4">
                    <input type="text" v-model="current.contacts"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="current.info"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>

                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" />
    </div>


    <!-- hidden ADD menu -->
    <div v-if="showAdd"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Pievienot vakanci</h1>
            <button @click="toggleAdd" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Nosaukums</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.title"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Bilde</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.image"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Uzņēmums</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.company"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Slodze</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.time"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Atalgojums</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.salary"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Vieta</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.location"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Kontakti</td>
                <td class="p-4">
                    <input type="text" v-model="new_v.contacts"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="new_v.info"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>

                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" />
    </div>
</template>
<script>
import CustomButton from './CustomButton.vue';
import TextField from './TextField.vue';
export default {
    data: () => {
        return {
            vacancies: [
                {
                    title: 'v1',
                    company: 'uzn1',
                    time: 'pilna',
                    salary: '800',
                    location: 'liepaja',
                    contacts: '28536473',
                    image: 'https://images.unsplash.com/photo-1573496546735-c274b1fd186b?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    info: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit ut tortor pretium viverra suspendisse potenti.'
                },
                {
                    title: 'v2',
                    company: 'uzn2',
                    time: 'pusslodze',
                    salary: '1000',
                    location: 'riga',
                    contacts: '28346473',
                    image: 'https://images.unsplash.com/photo-1573496546735-c274b1fd186b?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    info: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit ut tortor pretium viverra suspendisse potenti.'
                },
                {
                    title: 'v3',
                    company: 'uzn3',
                    time: 'noteiktais laiks',
                    salary: '300',
                    location: 'ventspils',
                    contacts: '28565473',
                    image: 'https://images.unsplash.com/photo-1573496546735-c274b1fd186b?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    info: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit ut tortor pretium viverra suspendisse potenti.'
                },
            ],
            current: null,
            new_v: {
                title: '',
                company: '',
                time: '',
                salary: '',
                location: '',
                contacts: '',
                info: '',
                image: ''

            },
            showRead: false,
            showAdd: false,
            showEdit: false,
        }
    },
    components: {
        CustomButton,
        TextField,
    },
    methods: {
        toggleRead(v) {
            this.showRead = !this.showRead
            this.showEdit = false
            this.current = v;
        },
        toggleEdit(v) {
            this.showEdit = !this.showEdit
            this.showRead = false
            this.current = v;
        },
        toggleAdd() {
            this.showEdit = false
            this.showRead = false
            this.showAdd = !this.showAdd
        }
    }
}
</script>