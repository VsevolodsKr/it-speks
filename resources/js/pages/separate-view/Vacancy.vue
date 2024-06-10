<!-- 
 class="flex justify-around text-black dark:text-gray-50 max-[1024px]:flex-col max-[1024px]:md:flex-col max-[1024px]:items-center flex-wrap"> 
-->

<template>
    <Wrapper>
        <div
            class="min-[1440px]:grid grid-flow-col gap-12 max-[1440px]:flex max-[1440px]:flex-wrap justify-center dark:text-gray-50 text-black">


            <div v-if="current"
                class=" bg-white text-left flex flex-col gap-5 ring-1 ring-zinc-300 rounded-md p-10 shadow-xl  dark:bg-zinc-700">
                <h1 class="font-bold text-4xl border-b-2 border-dotted border-zinc-300 pb-5">{{ current.title }}</h1>
                <h3 class="font-bold text-xl">Uzņēmums:</h3>
                <p class="text-xl">{{ current.company }}</p>
                <h3 class="font-bold text-xl">Atalgojums:</h3>
                <p class="text-xl ">{{ current.salary }}</p>
                <h3 class="font-bold text-xl">Pilsēta:</h3>
                <p class="text-xl ">{{ current.location }}</p>
                <h3 class="font-bold text-xl">Apraksts:</h3>
                <p class="text-xl max-w-3xl min-w-96">{{ current.description }}</p>
                <h3 class="font-bold text-xl">Kontakti:</h3>
                <p class="text-xl ">{{ current.contacts }}</p>
            </div>
            <div v-if="current">
                <div class="max-w-2xl h-80 overflow-hidden relative rounded-xl shadow-2xl m-auto">
                    <img :src="current.image_path" class="absolute top-1/2 -translate-y-1/2">
                </div>
                <div
                    class="flex flex-col items-center bg-white dark:bg-zinc-700 p-5 my-10 rounded-xl ring-2 ring-gray-300 shadow-xl">
                    <h3 class="font-bold text-2xl text-center">Pieteikties vakancei</h3>
                    <h2 class="bg-calm-green p-5 rounded-xl text-white font-bold text-2xl text-center mt-4 w-fit">
                        {{ current.title }}</h2>
                </div>
                <form class="flex flex-col items-center" @submit.prevent="add">
                    <h1 class="text-left w-full">Vārds</h1>
                    <input type="text" v-model="new_a.name" placeholder="Vārds"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <h1 class="text-left w-full">Uzvārds</h1>
                    <input type="text" v-model="new_a.surname" placeholder="Uzvārds"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <h1 class="text-left w-full">Dzimšanas datums</h1>
                    <input type="date" v-model="new_a.date"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md">
                    <h1 class="text-left w-full">Tel. nummurs</h1>
                    <input type="tel" v-model="new_a.phone" placeholder="Tālrunis"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <h1 class="text-left w-full">Epasts</h1>
                    <input type="email" v-model="new_a.email" placeholder="E-pasts"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <h1 class="text-left w-full">Komentāri</h1>
                    <textarea v-model="new_a.comments" col="30" rows="8" placeholder="Papildinformācija"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 resize-none bg-white dark:bg-zinc-700 w-full  shadow-md"></textarea>
                    <CustomButton :title="'Pieteikties'" :type="'submit'" class="w-full" />
                </form>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from "../../components/Wrapper.vue"
import CustomButton from "../../components/CustomButton.vue"

export default {
    data() {
        return {
            current: null,
            new_a: {
                name: '',
                surname: '',
                date: null,
                phone: '',
                email: '',
                comments: '',
            }
        }
    },
    mounted() {
        this.getVacancies()
    },
    methods: {
        async getVacancies() {
            await axios.get('/api/vacancies/' + this.$route.params.id)
                .then((response) => {
                    this.current = response.data;

                    this.current.image_path = new URL(this.current.image_path, import.meta.url)
                    console.log(response)
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        add() {
            let app_data = new FormData();
            app_data.append('name', this.new_a.name);
            app_data.append('surname', this.new_a.surname);
            app_data.append('phone', this.new_a.phone);
            app_data.append('email', this.new_a.email);
            app_data.append('comments', this.new_a.comments);
            app_data.append('date', this.new_a.date);
            app_data.append('vacancy', this.$route.params.id);
            axios.post('/api/applications/add', app_data).then((r) => {
                console.log(r.data);
            })
                .catch(error => {
                    console.error(error);
                });
        }
    },

    components: {
        Wrapper,
        CustomButton,
    }
}
</script>
