<template>
    <Wrapper>
        <div
            class="flex justify-around gap-10 text-black dark:text-gray-50 max-[1024px]:flex-col max-[1024px]:md:flex-col max-[1024px]:items-center">

            <div v-if="current" class="w-1/2 max-[1024px]: w-full max-[1024px]: text-left">
                <h1 class="font-bold text-4xl mb-10">{{ current.title }}</h1>
                <h3 class="font-bold text-2xl">Uzņēmums:</h3>
                <p class="text-2xl mb-10">{{ current.company }}</p>
                <h3 class="font-bold text-2xl">Atalgojums:</h3>
                <p class="text-2xl mb-10">{{ current.salary }}</p>
                <h3 class="font-bold text-2xl">Pilsēta:</h3>
                <p class="text-2xl mb-10">{{ current.location }}</p>
                <h3 class="font-bold text-2xl">Apraksts:</h3>
                <p class="text-2xl mb-10">{{ current.description }}</p>
                <h3 class="font-bold text-2xl">Kontakti:</h3>
                <p class="text-2xl mb-10">{{ current.contacts }}</p>
            </div>
            <div v-if="current">
                <img :src="current.image_path">
                <h3 class="font-bold text-2xl text-center mt-10">Pieteikties vakancei<br>Front-end developer</h3>
                <form class="flex flex-col items-center" method="post">
                    <TextField :type="'text'" :placeholder="'Vārds'" class="w-full" />
                    <TextField :type="'text'" :placeholder="'Uzvārds'" class="w-full" />
                    <TextField :type="'tel'" :placeholder="'Tālrunis'" class="w-full" />
                    <TextField :type="'email'" :placeholder="'E-pasts'" class="w-full" />
                    <TextArea :placeholder="'Papildinformācija'" class="w-full" />
                    <CustomButton :title="'Pievienot dokumentu'" :gray="true" class="w-full mb-5" />
                    <CustomButton :title="'Pieteikties'" class="w-full" />
                </form>
            </div>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from "../components/Wrapper.vue"
import CustomButton from "../components/CustomButton.vue"
import TextField from "../components/TextField.vue"
import TextArea from "../components/TextArea.vue"
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
                    this.current = response.data[0];
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
        TextField,
        TextArea,
    }
}
</script>
