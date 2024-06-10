<template>
    <div class="flex flex-col items-center gap-8 text-black dark:text-gray-50 ">
        <h3 class="text-center font-bold">Kopā ir {{ vacancies.length }} vakances</h3>
        <CustomButton :title="'Pievienot vakanci'" @click="toggleAdd" />
        <CustomButton :title="'Atjaunot'" @click="getVacancies()" />
    </div>
    <!-- <img src="../../../storage/app/public/uploads/1717001027_download.jpg"> -->
    <div
        class="flex justify-center text-black dark:text-gray-50 ring-1  ring-gray-300 rounded-xl p-10 dark:bg-zinc-700 shadow-xl bg-white">
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
                    <td class=" p-9 text-center border-r-2 border-gray-300 border-dashed ">
                        <div class="w-64 h-40 overflow-hidden rounded-md relative shadow-xl">
                            <img :src="v.image_path" class="w-full absolute top-1/2 -translate-y-1/2">
                        </div>
                    </td>
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
                    <td class="text-center px-5 border-r-2 border-gray-300 border-dashed">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleEdit(v)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                    </td>
                    <td class="text-center px-5">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleDelete(v)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- hidden READ menu -->
    <div v-if="showRead"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 text-black dark:text-gray-50 dark:bg-zinc-700 z-50">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">{{ current.title }}</h1>
            <button @click="toggleRead" class="text-3xl transition-colors hover:text-emerald-600"><i
                    class="fa-regular fa-circle-xmark"></i></button>
        </div>
        <p class="break-words">{{ current.description }}</p>
    </div>

    <!-- hidden DELETE menu -->
    <div v-if="showDelete"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 text-black dark:text-gray-50 dark:bg-zinc-700 z-50">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">Nodzēst {{ current.title }}</h1>
            <button @click="toggleDelete()" class="text-3xl transition-colors hover:text-emerald-600"><i
                    class="fa-regular fa-circle-xmark"></i></button>
        </div>
        <h3 class="font-bold text-center my-4">Vai Jūs tiešām gribāt nodzēst "{{ current.title }}"?</h3>
        <div class="flex justify-center gap-4 mt-12">
            <CustomButton :title="'Apstiprināt'" :red="true" @click="deleteVacancy" />
            <CustomButton @click="toggleDelete" :title="'Atcelt'" :gray="true" />
        </div>
    </div>
    <!-- hidden EDIT menu -->
    <div v-if="showEdit"
        class="text-black dark:text-gray-50 dark:bg-zinc-700 ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen">
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
                    <input type="text" v-model="edit_v.title"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                </td>
            </tr>

            <tr>
                <td class="font-bold">Uzņēmums</td>
                <td class="p-4">
                    <input type="text" v-model="edit_v.company"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Slodze</td>
                <td class="p-4">
                    <input type="text" v-model="edit_v.time"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Atalgojums</td>
                <td class="p-4">
                    <input type="text" v-model="edit_v.salary"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Vieta</td>
                <td class="p-4">
                    <input type="text" v-model="edit_v.location"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Kontakti</td>
                <td class="p-4">
                    <input type="text" v-model="edit_v.contacts"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="edit_v.description"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700"></textarea>

                </td>
            </tr>
            <tr>
                <td class="font-bold">Attēls</td>
                <td class="p-4">
                    <input type="file" accept="image/*" @change="handleFileChange" />
                </td>
            </tr>
        </table>
        <CustomButton @click="editVacancy" :title="'Saglabāt'" />
    </div>


    <!-- hidden ADD menu -->
    <div v-if="showAdd"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-zinc-700 z-50">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Pievienot vakanci</h1>
            <button @click="toggleAdd" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>
        <form enctype="multipart/form-data">


            <table>
                <tr>
                    <td class="font-bold">Nosaukums</td>
                    <td class="p-4">
                        <input required type="text" v-model="new_v.title"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Uzņēmums</td>
                    <td class="p-4">
                        <input required type="text" v-model="new_v.company"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Slodze</td>
                    <td class="p-4">
                        <input required type="text" v-model="new_v.time"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Atalgojums</td>
                    <td class="p-4">
                        <input required type="text" v-model="new_v.salary"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Vieta</td>
                    <td class="p-4">
                        <input required type="text" v-model="new_v.location"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Kontakti</td>
                    <td class="p-4">
                        <input required type="text" v-model="new_v.contacts"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700">
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Apraksts</td>
                    <td class="p-4">
                        <textarea required v-model="new_v.description"
                            class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-zinc-700"></textarea>

                    </td>
                </tr>
                <tr>
                    <td class="font-bold">Attēls</td>
                    <td class="p-4">
                        <input type="file" @change="handleFileChange" required />
                    </td>
                </tr>
            </table>
            <CustomButton :title="'Saglabāt'" :type="'submit'" @click="add" />
        </form>
    </div>

</template>
<script>
import CustomButton from '../CustomButton.vue';

export default {
    data: () => {
        return {
            vacancies: [],
            current: null,
            new_v: {
                title: '',
                company: '',
                time: '',
                salary: '',
                location: '',
                contacts: '',
                description: '',
                image_path: '',
            },
            edit_v: null,
            showRead: false,
            showAdd: false,
            showEdit: false,
            showDelete: false,
            file: null,
        }
    },
    components: {
        CustomButton,
    },
    mounted() {
        this.getVacancies();
    },
    methods: {
        handleFileChange(event) {
            this.file = event.target.files[0];
        },
        add(e) {
            e.preventDefault()
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('title', this.new_v.title);
            data.append('company', this.new_v.company);
            data.append('time', this.new_v.time);
            data.append('salary', this.new_v.salary);
            data.append('location', this.new_v.location);
            data.append('contacts', this.new_v.contacts);
            data.append('description', this.new_v.description);
            data.append('file', this.file);

            axios.post('api/vacancies/add', data, config)
                .then((r) => {
                    console.log(r.data)
                    this.getVacancies();
                    this.file = null
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        toggleRead(v) {
            this.showRead = !this.showRead
            this.showEdit = false
            this.current = v;
            this.file = null
        },
        toggleEdit(vac) {
            this.showEdit = !this.showEdit
            this.showRead = false

            this.current = vac
            this.edit_v = {
                'title': vac.title,
                'company': vac.company,
                'time': vac.time,
                'salary': vac.salary,
                'location': vac.location,
                'contacts': vac.contacts,
                'description': vac.description,
                'image_path': vac.image_path,
            }
            this.file = null
        },
        toggleAdd() {
            this.showEdit = false
            this.showRead = false
            this.showAdd = !this.showAdd
            this.file = null
        },
        toggleDelete(n) {
            this.showDelete = !this.showDelete
            this.showRead = false
            this.showEdit = false
            this.current = n;
            this.file = null
        },
        getVacancies() {
            axios.get('api/vacancies')
                .then((response) => {
                    this.vacancies = response.data
                    this.vacancies.forEach((v) => {
                        v.image_path = new URL(v.image_path, import.meta.url)
                    })
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        deleteVacancy() {
            axios.delete('/api/vacancies/delete/' + this.current.id)
                .then((res) => {
                    console.log(res)
                    this.getVacancies()
                    this.toggleDelete(null);
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        editVacancy() {
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('title', this.edit_v.title);
            data.append('company', this.edit_v.company);
            data.append('time', this.edit_v.time);
            data.append('salary', this.edit_v.salary);
            data.append('location', this.edit_v.location);
            data.append('contacts', this.edit_v.contacts);
            data.append('description', this.edit_v.description);
            if (this.file) {
                data.append('file', this.file);
            } else {
                data.append('image_path', this.edit_v.image_path);
            }
            axios.post('/api/vacancies/update/' + this.current.id, data, config)
                .then((res) => {
                    console.log(res)
                    this.getVacancies()
                    this.file = null
                    this.toggleEdit(null)
                })
                .catch((err) => {
                    console.error(err)
                })
        },
    }
}
</script>