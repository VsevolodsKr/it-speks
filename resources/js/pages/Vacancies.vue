<template>
    <Wrapper>
        <h1 class="text-3xl font-bold text-center">Vakances</h1>

        <!-- row 1 -->
        <div>
            <h2 class="text-xl tracking-wider underline">Meklēšana</h2>
            <form class="items-center gap-3 grid grid-flow-col justify-stretch">
                <TextField :placeholder="'Vēlamā vakance'" />
                <Dropdown :elements="cities" />
                <CustomButton :title="'Meklēt'" />
            </form>
        </div>

        <!-- row 2 -->
        <div>
            <h2 class="text-xl tracking-wider underline">Filtri</h2>
            <form class="flex flex-col items-end">
                <div class="gap-3 grid grid-flow-col justify-stretch w-full">
                    <!-- amats -->
                    <Dropdown :elements="prof" />
                    <!-- pilseta -->
                    <Dropdown :elements="cities" />
                    <!-- slodze -->
                    <Dropdown :elements="time" />
                    <!-- atalgojums -->
                    <Dropdown :elements="pay" />
                </div>
                <div class="flex gap-5">
                    <CustomButton :title="'Notirīt'" />
                    <CustomButton :title="'Filtrēt'" />
                </div>
            </form>
        </div>


        <!-- vacancies -->
        <div class="grid grid-cols-3 gap-10 justify-center items-center">
            <Block v-for="vac in vacancies" :title="vac.title" :desc="vac.desc" :btnTitle="vac.btnTitle" />
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
                    title: 'Pirmais',
                    desc: 'pirmais apraksts',
                    btnTitle: 'Pieteikties',
                },
                {
                    title: 'Otrais',
                    desc: 'Otrais apraksts',
                    btnTitle: 'Pieteikties',
                },
                {
                    title: 'Trešais',
                    desc: 'Trešais apraksts',
                    btnTitle: 'Pieteikties',
                },
                {
                    title: 'Ceturtais',
                    desc: 'Ceturtais apraksts',
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