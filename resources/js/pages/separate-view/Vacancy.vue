<template>
    <Wrapper>
        <div
            class="flex justify-around text-black dark:text-gray-50 max-[1024px]:flex-col max-[1024px]:md:flex-col max-[1024px]:items-center flex-wrap">

            <div v-if="current"
                class="max-[1024px]:  w-max-3xl max-[1024px]: text-left flex flex-col gap-5 ring-1 ring-zinc-300 rounded-md p-10 shadow-xl  dark:bg-zinc-700">
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
                <div style="width: 700px;" class="h-96 overflow-hidden relative rounded-xl shadow-2xl">
                    <img :src="current.image_path" class="absolute top-1/2 -translate-y-1/2">
                </div>
                <h3 class="font-bold text-2xl text-center mt-10">Pieteikties vakancei<br>Front-end developer</h3>
                <form class="flex flex-col items-center" method="post">

                    <input type="text" placeholder="Vārds"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <input type="text" placeholder="Uzvārds"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <input type="tel" placeholder="Tālrunis"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <input type="email" placeholder="E-pasts"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50 w-full shadow-md" />
                    <textarea col="30" rows="8" placeholder="Papildinformācija"
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 resize-none bg-white dark:bg-zinc-700 w-full  shadow-md"></textarea>
                    <CustomButton :title="'Pievienot dokumentu'" :gray="true" class="w-full mb-5" />
                    <CustomButton :title="'Pieteikties'" class="w-full" />
                </form>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from "../../components/Wrapper.vue"
import CustomButton from "../../components/CustomButton.vue"

import axios from "axios";

export default {
    data() {
        return {
            current: null,
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
    },

    components: {
        Wrapper,
        CustomButton,
    }
}
</script>
