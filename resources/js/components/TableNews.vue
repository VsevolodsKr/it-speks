<template>
    <div class="flex flex-col items-center gap-8 text-black dark:text-gray-50 ">
        <h3 class="text-center font-bold">Kopā ir {{ news.length }} aktualitātes</h3>
        <CustomButton :title="'Pievienot aktualitāti'" @click="toggleAdd" />
        <CustomButton :title="'Atjaunot'" @click="getNews()" />
    </div>
    <div class="flex justify-center text-black dark:text-gray-50 ">
        <div class="overflow-x-scroll scroll-pl-6 p-5">
            <table class="ring-1 ring-gray-300 rounded-md  w-max ">
                <tr class="h-12 ring-1 ring-gray-300 rounded-t-md">
                    <th></th>
                    <th>Nosaukums</th>
                    <th>Īss apraksts</th>
                </tr>
                <tr v-for="n, index in news" :key="index"
                    :class="[(index == news.length - 1) ? '' : 'border-b-gray-300 border-b-2 border-dashed', 'h-10']">
                    <td class="text-center border-r-2 border-gray-300 border-dashed p-9"><img :src="n.image_path"
                            class="max-w-64 rounded-md"></td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed px-48">{{ n.title }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed max-w-96 px-8">{{ n.short_desc }}
                    </td>

                    <td class="text-center border-r-2 border-gray-300 border-dashed p-2">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleRead(n)"><i class="fa-solid fa-book-open"></i></button>
                    </td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed p-2">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleEdit(n)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                    </td>
                    <td class="text-center p-2">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleDelete(n)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- hidden DELETE menu -->
    <div v-if="showDelete"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">Nodzēst {{ current.title }}</h1>
            <button @click="toggleDelete" class="text-3xl transition-colors hover:text-emerald-600"><i
                    class="fa-regular fa-circle-xmark"></i></button>
        </div>
        <h3 class="mt-5">{{ current.short_desc }}</h3>
        <h3 class="font-bold text-center my-4">Vai Jūs tiešām gribāt nodzēst "{{ current.title }}"?</h3>
        <div class="flex justify-center gap-4 mt-12">
            <CustomButton :title="'Apstiprināt'" :red="true" @click="deleteNews" />
            <CustomButton @click="toggleDelete" :title="'Atcelt'" :gray="true" />
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
        <h3>{{ current.short_desc }}</h3>
        <p>{{ current.description }}</p>
    </div>


    <!-- hidden EDIT menu -->
    <div v-if="showEdit"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-slate-700">
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
                    <input type="text" v-model="edit_n.title"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Īss apraksts</td>
                <td class="p-4">
                    <textarea v-model="edit_n.short_desc"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="edit_n.description"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Attēls</td>
                <td class="p-4">
                    <input type="file" @change="handleFileChange" required />
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" @click="editNews" />
    </div>


    <!-- hidden ADD menu -->
    <div v-if="showAdd"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center overflow-y-scroll max-h-screen text-black dark:text-gray-50 dark:bg-slate-700">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">Pievienot aktualitāti</h1>
            <button @click="toggleAdd" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Nosaukums</td>
                <td class="p-4">
                    <input type="text" v-model="new_n.title"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>

            <tr>
                <td class="font-bold">Īss apraksts</td>
                <td class="p-4">
                    <textarea v-model="new_n.short_desc"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="new_n.description"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Attēls</td>
                <td class="p-4">
                    <input type="file" @change="handleFileChange" required />
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" @click="addNews" />
    </div>
</template>
<script>
import CustomButton from './CustomButton.vue';
export default {
    data: () => {
        return {
            news: [],
            current: null,
            new_n: {
                title: '',
                short_desc: '',
                description: '',
            },
            edit_n: null,
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
        this.getNews();
    },
    methods: {
        handleFileChange(event) {
            this.file = event.target.files[0];
        },
        toggleRead(n) {
            this.showRead = !this.showRead
            this.showEdit = false
            this.showDelete = false
            this.current = n;
            this.file = null;
        },
        toggleEdit(n) {
            this.showEdit = !this.showEdit
            this.showRead = false
            this.showDelete = false
            this.current = n;
            this.file = null;
            this.edit_n = {
                'title': n.title,
                'short_desc': n.short_desc,
                'description': n.description,
                'image_path': n.image_path,
            }
        },
        toggleAdd() {
            this.showEdit = false
            this.showRead = false
            this.showDelete = false
            this.showAdd = !this.showAdd
            this.file = null;
        },
        toggleDelete(n) {
            this.showDelete = !this.showDelete
            this.showRead = false
            this.showEdit = false
            this.current = n;
            this.file = null;
        },
        addNews() {
            const config = {
                headers: {
                    'description-Type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('title', this.new_n.title);
            data.append('short_desc', this.new_n.short_desc);
            data.append('description', this.new_n.description);
            data.append('file', this.file);

            axios.post('/api/news/add', data, config)
                .then((r) => {
                    console.log(r.data)
                    this.getNews();
                    this.file = null
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        getNews() {
            axios.get('api/news')
                .then((response) => {
                    this.news = response.data
                    this.news.forEach((n) => {
                        n.image_path = new URL(n.image_path, import.meta.url)
                    })
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        editNews() {
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('title', this.edit_n.title);
            data.append('short_desc', this.edit_n.short_desc);
            data.append('description', this.edit_n.description);
            if (this.file) {
                data.append('file', this.file);
            } else {
                data.append('image_path', this.edit_n.image_path);
            }
            axios.post('/api/news/update/' + this.current.id, data, config)
                .then((res) => {
                    console.log(res)
                    this.getNews()
                    this.file = null
                    this.toggleEdit(null)
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        deleteNews() {
            axios.delete('/api/news/delete/' + this.current.id)
                .then((res) => {
                    console.log(res)
                    this.getNews()
                    this.toggleDelete(null);
                })
                .catch((err) => {
                    console.error(err)
                })
        },

    }
}
</script>