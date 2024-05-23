<template>
    <div class="flex flex-col items-center gap-8 text-black dark:text-gray-50 ">
        <h3 class="text-center font-bold">Kopā ir {{ news.length }} aktualitātes</h3>
        <CustomButton :title="'Pievienot aktualitāti'" @click="toggleAdd" />
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
                    <td class="text-center border-r-2 border-gray-300 border-dashed p-9"><img :src="n.image"
                            class="max-w-64 rounded-md"></td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed px-48">{{ n.title }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed max-w-96 px-8">{{ n.shortcontent }}
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
        <h3 class="mt-5">{{ current.shortcontent }}</h3>
        <h3 class="font-bold text-center my-4">Vai Jūs tiešām gribāt nodzēst "{{ current.title }}"?</h3>
        <div class="flex justify-center gap-4 mt-12">
            <CustomButton :title="'Apstiprināt'" :red="true" />
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
        <h3>{{ current.shortcontent }}</h3>
        <p>{{ current.content }}</p>
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
                <td class="font-bold">Īss apraksts</td>
                <td class="p-4">
                    <textarea v-model="current.shortcontent"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="current.content"
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
                <td class="font-bold">Bilde</td>
                <td class="p-4">
                    <input type="text" v-model="new_n.image"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700">
                </td>
            </tr>
            <tr>
                <td class="font-bold">Īss apraksts</td>
                <td class="p-4">
                    <textarea v-model="new_n.shortcontent"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
            <tr>
                <td class="font-bold">Apraksts</td>
                <td class="p-4">
                    <textarea v-model="new_n.content"
                        class="ring-1 ring-gray-300 rounded-md px-3 py-2 text-black dark:text-gray-50 dark:bg-slate-700"></textarea>
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" />
    </div>
</template>
<script>
import CustomButton from './CustomButton.vue';
export default {
    data: () => {
        return {
            news: [
                {
                    title: 'akt1',
                    image: 'https://images.unsplash.com/photo-1573497019509-d715a631bbe5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    shortcontent: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit ut tortor pretium viverra suspendisse potenti.'
                },
                {
                    title: 'akt2',
                    image: 'https://images.unsplash.com/photo-1573497019509-d715a631bbe5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    shortcontent: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit ut tortor pretium viverra suspendisse potenti.'
                },
                {
                    title: 'akt3',
                    image: 'https://images.unsplash.com/photo-1573497019509-d715a631bbe5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    shortcontent: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit ut tortor pretium viverra suspendisse potenti.'
                },
            ],
            current: null,
            new_n: {
                title: '',
                shortcontent: '',
                content: '',
                image: '',
            },
            showRead: false,
            showAdd: false,
            showEdit: false,
            showDelete: false,
        }
    },
    components: {
        CustomButton,
    },
    methods: {
        toggleRead(n) {
            this.showRead = !this.showRead
            this.showEdit = false
            this.showDelete = false
            this.current = n;
        },
        toggleEdit(n) {
            this.showEdit = !this.showEdit
            this.showRead = false
            this.showDelete = false
            this.current = n;
        },
        toggleAdd() {
            this.showEdit = false
            this.showRead = false
            this.showDelete = false
            this.showAdd = !this.showAdd
        },
        toggleDelete(n) {
            this.showDelete = !this.showDelete
            this.showRead = false
            this.showEdit = false
            this.current = n;
        }
    }
}
</script>