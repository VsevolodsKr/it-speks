<template>
    <h3 class="text-center font-bold text-black dark:text-gray-50">Kopā ir {{ applications.length }} pieteikumi</h3>
    <div class="flex justify-center">
        <div
            class="flex justify-center text-black dark:text-gray-50 ring-1 ring-gray-300 rounded-xl p-10 dark:bg-zinc-700 shadow-xl w-fit bg-white">
            <div class="overflow-x-scroll scroll-pl-6 p-5">
                <table class="ring-1 ring-gray-300 rounded-md w-max ">
                    <tr class="h-12 ring-1 ring-gray-300 rounded-t-md">
                        <th class="px-5">Vārds</th>
                        <th class="px-5">Uzvārds</th>
                        <th>Datums</th>
                        <th>Tālrunis</th>
                        <th>E-pasts</th>
                        <th>Komentāri</th>
                        <th>Statuss</th>
                    </tr>
                    <tr v-for="a, index in applications" :key="index"
                        :class="[(index == applications.length - 1) ? '' : 'border-b-gray-300 border-b-2 border-dashed', 'h-10']">
                        <td class="px-5 text-center border-r-2 border-gray-300 border-dashed">{{ a.name }}</td>
                        <td class="px-5 text-center border-r-2 border-gray-300 border-dashed">{{ a.surname }}</td>
                        <td class="px-5 text-center border-r-2 border-gray-300 border-dashed">{{ a.birth_date }}</td>
                        <td class="px-5 text-center border-r-2 border-gray-300 border-dashed">{{ a.phone }}</td>
                        <td class="px-5 text-center border-r-2 border-gray-300 border-dashed">{{ a.email }}</td>
                        <td class="py-3 text-center border-r-2 border-gray-300 border-dashed">
                            <button
                                class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                                @click="toggleRead(a)"><i class="fa-solid fa-book-open"></i></button>
                        </td>
                        <td class="px-5 text-center border-r-2 border-gray-300 border-dashed">{{
                            statenames[a.status].title
                        }}
                        </td>
                        <td class="p-3 text-center">
                            <button
                                class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                                @click="toggleEdit(a)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- hidden READ menu -->
    <div v-if="showRead"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96  text-black dark:text-gray-50 dark:bg-zinc-700">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">{{ name }} {{ surname }}</h1>
            <button @click="toggleRead" class="text-3xl transition-colors hover:text-emerald-600"><i
                    class="fa-regular fa-circle-xmark"></i></button>
        </div>
        <p>{{ text }}</p>
    </div>


    <!-- hidden EDIT menu -->
    <div v-if="showEdit"
        class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center text-black dark:text-gray-50 dark:bg-zinc-700">
        <div class="flex justify-between w-full">
            <h1 class="font-bold text-xl">{{ name }} {{ surname }}</h1>
            <button @click="toggleEdit" class="text-3xl transition-colors hover:text-emerald-600">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </div>

        <table>
            <tr>
                <td class="font-bold">Datums</td>
                <td>{{ date }}</td>
            </tr>
            <tr>
                <td class="font-bold">Tālrunis</td>
                <td>{{ phone }}</td>
            </tr>
            <tr>
                <td class="font-bold">E-pasts</td>
                <td>{{ email }}</td>
            </tr>
            <tr>
                <td class="pr-5 font-bold">Komentārs</td>
                <td>{{ text }}</td>
            </tr>
            <tr>
                <td class="font-bold">Statuss</td>
                <td>
                    <form action="">
                        <select v-model="state"
                            class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 text-black dark:text-gray-50">
                            <option v-for="el, index in statenames" :key="index" :value="index">{{ el.title }}</option>
                        </select>
                    </form>
                </td>
            </tr>
        </table>
        <CustomButton :title="'Saglabāt'" @click="changeStatus"/>
    </div>
</template>
<script>

import CustomButton from '../CustomButton.vue';
export default {
    data: () => {
        return {
            current: null,
            applications: [],
            statenames: [
                { title: 'Iesniegts' },
                { title: 'Apstiprināts' },
                { title: 'Pārbaudīts' },
                { title: 'Noraidīts/Dzēsts' },
            ],
            name: '',
            surname: '',
            date: '',
            phone: '',
            email: '',
            text: '',
            state: '',
            showRead: false,
            showEdit: false,
            showDelete: false,
        }
    },
    mounted() {
        this.getApplications();
    },
    components: {
        CustomButton,
    },
    methods: {
        getApplications() {
            axios.get('/api/applications')
                .then((response) => {
                    this.applications = response.data
                    console.log(this.applications)
                })
                .catch((err) => {
                    console.error(err)
                })
        },
        toggleRead(a) {
            this.showRead = !this.showRead;
            this.save(a);
        },
        toggleEdit(a) {
            this.showEdit = !this.showEdit;
            this.save(a);
            this.current = a;
        },
        save(a) {
            this.name = a.name;
            this.surname = a.surname;
            this.date = a.birth_date;
            this.phone = a.phone;
            this.email = a.email;
            this.text = a.comments;
            this.state = a.status;
        },
        changeStatus(){
            let status_data = new FormData();
            status_data.append('status', this.state);
            axios.post('/api/applications/changeStatus/' + this.current.id, status_data).then((r) => {
                this.getApplications();
                console.log(r)
                this.showEdit = false;
            }).catch((err) => {
                console.error(err);
            });
        },
    }
}
</script>