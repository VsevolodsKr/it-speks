<template>
    <Wrapper>
        <div class="flex justify-around gap-10 text-black dark:text-gray-50">
            <div v-if="current" class="w-1/2">
                <h1 class="font-bold text-4xl mb-10">{{ current.title }}</h1>
                <h3 class="font-bold text-2xl">Uzņēmums:</h3>
                <p class="text-2xl mb-10">{{ current.company }}</p>
                <h3 class="font-bold text-2xl">Atalgojums:</h3>
                <p class="text-2xl mb-10">{{ current.salary }}</p>
                <h3 class="font-bold text-2xl">Pilsēta:</h3>
                <p class="text-2xl mb-10">{{ current.city }}</p>
                <h3 class="font-bold text-2xl">Apraksts:</h3>
                <p class="text-2xl mb-10">{{ current.description }}</p>
                <h3 class="font-bold text-2xl">Kontakti:</h3>
                <p class="text-2xl mb-10">{{ current.contacts }}</p>
            </div>
            <div>
                <img src="../../images/main2.png">
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

export default {
    data() {
        return {
            vacancies: [
                {
                    id: 0,
                    title: "A Front-end developer",
                    company: "SIA \"Kompānija A\"",
                    salary: "1000 EUR",
                    city: "Liepāja",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam perferendis harum ipsam, ducimus",
                    contacts: "+371 212324567 zvanot vai rakstot Whatsapp",
                }, {
                    id: 1,
                    title: "B Front-end developer",
                    company: "SIA \"Kompānija A\"",
                    salary: "1000 EUR",
                    city: "Liepāja",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam perferendis harum ipsam, ducimus",
                    contacts: "+371 212324567 zvanot vai rakstot Whatsapp",
                }, {
                    id: 2,
                    title: "C Front-end developer",
                    company: "SIA \"Kompānija A\"",
                    salary: "1000 EUR",
                    city: "Liepāja",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam perferendis harum ipsam, ducimus",
                    contacts: "+371 212324567 zvanot vai rakstot Whatsapp",
                },
            ],
            current: null,
        }
    },
    mounted() {
        const vacancy = this.vacancies.find(vacancy => vacancy.id === parseInt(this.$route.params.id));
        this.current = vacancy;
    },
    components: {
        Wrapper,
        CustomButton,
        TextField,
        TextArea,
    }
}
</script>
