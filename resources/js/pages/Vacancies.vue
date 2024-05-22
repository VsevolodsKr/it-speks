<template>
    <Wrapper>
        <h1 class="text-3xl font-bold text-center dark:text-gray-50 text-black">Vakances</h1>

        <!-- row 1 -->
        <div>
            <h2 class="text-xl tracking-wider underline dark:text-gray-50 text-black">Meklēšana</h2>
            <form class="items-center gap-3 flex flex-wrap">
                <TextField :placeholder="'Vēlamā vakance'" />
                <Dropdown :elements="cities" />
                <CustomButton :title="'Meklēt'" />
            </form>
        </div>

        <!-- row 2 -->
        <div>
            <h2 class="text-xl tracking-wider underline dark:text-gray-50 text-black">Filtri</h2>
            <form class="flex flex-col">
                <div class="gap-3 flex flex-wrap w-full">
                    <!-- amats -->
                    <Dropdown :elements="prof" />
                    <!-- pilseta -->
                    <Dropdown :elements="cities" />
                    <!-- slodze -->
                    <Dropdown :elements="time" />
                    <!-- atalgojums -->
                    <Dropdown :elements="pay" />
                </div>
                <div class="flex gap-5 flex-wrap">
                    <CustomButton :title="'Notirīt'" />
                    <CustomButton :title="'Filtrēt'" />
                </div>
            </form>
        </div>


        <!-- vacancies -->
        <div class="grid grid-cols-3 gap-10 justify-center items-center a">
            <Block v-for="vac in vacancies" :data="vac" :route="'vacancies'" :btnTitle="vac.btnTitle" />
        </div>


        <!-- num -->
        <h3 class="text-gray-500 text-center font-bold"><span class="underline">{{ vacancies.length
                }}</span><br>vakances
        </h3>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import TextField from '../components/TextField.vue'
import Dropdown from '../components/Dropdown.vue'
import CustomButton from '../components/CustomButton.vue'
import Block from '../components/Block.vue'
export default {
    data: () => {
        return {
            prof: [],
            cities: [
                { title: 'Rīga', },
                { title: 'Liepāja', },
                { title: 'Ventspils', },
                { title: 'Kuldīga', },
                { title: 'Jūrmala', },
            ],
            time: [],
            pay: [],
            vacancies: [
                {
                    id: 0,
                    title: 'Pirmais',
                    desc: 'pirmais apraksts',
                    btnTitle: 'Pieteikties',
                },
                {
                    id: 1,
                    title: 'Otrais',
                    desc: 'Otrais apraksts',
                    btnTitle: 'Pieteikties',
                },
                {
                    id: 2,
                    title: 'Trešais',
                    desc: 'Trešais apraksts',
                    btnTitle: 'Pieteikties',
                },
            ],
        }
    },
    components: {
        Wrapper,
        TextField,
        Dropdown,
        Block,
        CustomButton,
    }
}
</script>


<style scoped>
@media(max-width:1515px) {
    .a {
        display: flex;
        flex-wrap: wrap;
    }
}
</style>