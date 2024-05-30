<template>
    <Wrapper>
        <div
            class="flex justify-around gap-10 text-black dark:text-gray-50 max-[1024px]:flex-col max-[1024px]:md:flex-col max-[1024px]:items-center flex-wrap">

            <div v-if="current"
                class="break-words max-[1024px]:  w-max-3xl max-[1024px]: text-left flex flex-col gap-5">
                <h1 class="font-bold text-4xl ">{{ current.title }}</h1>
                <h3 class="font-bold text-xl">Uzņēmums:</h3>
                <p class="text-xl">{{ current.company }}</p>
                <h3 class="font-bold text-xl">Atalgojums:</h3>
                <p class="text-xl ">{{ current.salary }}</p>
                <h3 class="font-bold text-xl">Pilsēta:</h3>
                <p class="text-xl ">{{ current.location }}</p>
                <h3 class="font-bold text-xl">Apraksts:</h3>
                <p class="text-xl break-words max-w-xl">{{ current.description }}</p>
                <h3 class="font-bold text-xl">Kontakti:</h3>
                <p class="text-xl ">{{ current.contacts }}</p>
            </div>
            <div v-if="current">
                <div style="width: 700px;" class="h-96 overflow-hidden relative">
                    <img :src="current.image_path" class="absolute top-1/2 -translate-y-1/2">
                </div>
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
        TextField,
        TextArea,
    }
}
</script>
