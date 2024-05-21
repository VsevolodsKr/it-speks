<template>
    <Wrapper>
        <div class="text-center font-bold">
            <h1 class="text-4xl">Administracijas panelis</h1>
            <h2 class="my-5">Laipni lūgti administracijas panelī, <span class="underline">{{ username
                    }}</span>!</h2>
            <h2>Jūs esat: <span class="underline">{{ role == 1 ? "administrators" : "moderators" }}</span></h2>
        </div>
        <div class="flex justify-evenly">
            <h1 :class="[current == 0 ? ' bg-emerald-800 text-white font-bold' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 0">
                Pieteikumi
            </h1>
            <h1 :class="[current == 1 ? ' bg-emerald-800 text-white font-bold' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 1">
                Vakances</h1>
            <h1 :class="[current == 2 ? ' bg-emerald-800 text-white font-bold' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 2">
                Aktualitātes</h1>
            <h1 :class="[current == 3 ? ' bg-emerald-800 text-white font-bold' : '', 'rounded-md py-2 px-8 cursor-pointer transition-all hover:shadow-xl ring-1 ring-gray-100']"
                @click="current = 3">
                Lietotāji</h1>
        </div>


        <!-- Pieteikumi -->
        <div v-if="current == 0" class="flex flex-col gap-12">
            <h3 class="text-center font-bold">Kopā ir {{ applications.length }} pieteikumi</h3>
            <table class="ring-1 ring-gray-300 rounded-md">
                <tr class="h-12 ring-1 ring-gray-300 rounded-t-md">
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Datums</th>
                    <th>Tālrunis</th>
                    <th>E-pasts</th>
                    <th>Komentāri</th>
                    <th>Statuss</th>
                </tr>
                <tr v-for="a, index in applications" :key="index"
                    :class="[(index == applications.length - 1) ? '' : 'border-b-gray-300 border-b-2 border-dashed', 'h-10']">
                    <td class="text-center border-r-2 border-gray-300 border-dashed">{{ a.name }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">{{ a.surname }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">{{ a.date }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">{{ a.phone }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">{{ a.email }}</td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleRead(a)"><i class="fa-solid fa-book-open"></i></button>
                    </td>
                    <td class="text-center border-r-2 border-gray-300 border-dashed">{{ statenames[a.state].title }}
                    </td>
                    <td class="text-center">
                        <button
                            class="hover:bg-emerald-800 ring-1 ring-gray-300 text-emerald-800 hover:text-white font-bold rounded-md px-4 py-2 hover:shadow-md transition-all "
                            @click="toggleEdit(a)"><i class="fa-solid fa-pen-to-square text-xl"></i></button>
                    </td>
                </tr>
            </table>
        </div>

        <!-- hidden READ menu -->
        <div v-if="showRead"
            class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96">
            <div class="flex justify-between">
                <h1 class="font-bold text-xl">{{ name }} {{ surname }}</h1>
                <button @click="toggleRead" class="text-3xl transition-colors hover:text-emerald-600"><i
                        class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <p>{{ text }}</p>
        </div>


        <!-- hidden EDIT menu -->
        <div v-if="showEdit"
            class="ring-1 ring-gray-300 rounded-md p-5 shadow-xl max-w-5xl fixed  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white min-w-96 flex flex-col items-center">
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
                            <Dropdown :elements="statenames" />
                        </form>
                    </td>
                </tr>
            </table>
            <CustomButton :title="'Saglabāt'" />
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue';
import Dropdown from '../components/Dropdown.vue';
import CustomButton from '../components/CustomButton.vue';
import TextField from '../components/TextField.vue';
export default {
    data: () => {
        return {
            username: 'admin_A',
            role: 1,
            current: 0,
            imagename: null,
            applications: [
                {
                    name: 'Jānis',
                    surname: 'Jansons',
                    date: '2022-01-01',
                    phone: '21234567',
                    email: 'janis.jan@gmail.com',
                    info: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Luctus venenatis lectus magna fringilla urna. Neque egestas congue quisque egestas diam in arcu cursus euismod.1',
                    state: 0,
                },
                {
                    name: 'Kārlis',
                    surname: 'Karlos',
                    date: '2024-03-05',
                    phone: '21254367',
                    email: 'karlis.kar@gmail.com',
                    info: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Luctus venenatis lectus magna fringilla urna. Neque egestas congue quisque egestas diam in arcu cursus euismod.2',
                    state: 1,
                },
                {
                    name: 'Ieva',
                    surname: 'Priede',
                    date: '2024-05-06',
                    phone: '21239257',
                    email: 'ieva.pri@gmail.com',
                    info: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Luctus venenatis lectus magna fringilla urna. Neque egestas congue quisque egestas diam in arcu cursus euismod.3',
                    state: 2,
                },
            ],
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
    components: {
        Wrapper,
        Dropdown,
        CustomButton,
        TextField,
    },
    methods: {
        toggleRead(a) {
            this.showRead = !this.showRead;
            this.save(a);
        },
        toggleEdit(a) {
            this.showEdit = !this.showEdit;
            this.save(a);
        },
        save(a) {
            this.name = a.name;
            this.surname = a.surname;
            this.date = a.date;
            this.phone = a.phone;
            this.email = a.email;
            this.text = a.info;
            this.state = a.state;
        }

    }
}
</script>