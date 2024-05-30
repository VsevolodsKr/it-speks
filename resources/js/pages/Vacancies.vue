<template>
    <Wrapper>
        <h1 class="text-3xl font-bold text-center dark:text-gray-50 text-black">Vakances</h1>

        <!-- row 1 -->
        <div>
            <h2 class="text-xl tracking-wider underline dark:text-gray-50 text-black grid">Meklēšana</h2>
            <form class="items-center gap-5 min-[840px]:grid grid-flow-col justify-stretch flex-wrap max-[840px]:flex">
                <input type="text" placeholder="Vēlamā vakance" v-model="search"
                    class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 dark:text-gray-50">
                <!-- <Dropdown :elements="cities" :title="'Vieta'" /> -->
                <select v-model="searchlocation"
                    class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 text-black dark:text-gray-50">
                    <option value="-1" selected>Vieta</option>
                    <option v-for="el, index in cities" :key="index" :value="index">{{ el.title }}</option>
                </select>
                <CustomButton :title="'Meklēt'" @click="searchVacancies" />
            </form>
        </div>

        <!-- row 2 -->
        <div>
            <h2 class="text-xl tracking-wider underline dark:text-gray-50 text-black">Filtri</h2>
            <form class="flex flex-col">
                <div
                    class="items-center gap-5 min-[920px]:grid grid-flow-col justify-stretch flex-wrap max-[920px]:flex">
                    <!-- amats -->
                    <select
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 text-black dark:text-gray-50">
                        <option value="" class=" hidden" disabled selected>Amats</option>
                        <option v-for="el, index in prof" :key="index" :value="index">{{ el.title }}</option>
                    </select>
                    <!-- pilseta -->
                    <select
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 text-black dark:text-gray-50">
                        <option value="" class=" hidden" disabled selected>Vieta</option>
                        <option v-for="el, index in cities" :key="index" :value="index">{{ el.title }}</option>
                    </select>
                    <!-- slodze -->
                    <select
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 text-black dark:text-gray-50">
                        <option value="" class=" hidden" disabled selected>Slodze</option>
                        <option v-for="el, index in time" :key="index" :value="index">{{ el.title }}</option>
                    </select>
                    <!-- atalgojums -->
                    <select
                        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-zinc-700 text-black dark:text-gray-50">
                        <option value="" class=" hidden" disabled selected>Atalgojums</option>
                        <option v-for="el, index in pay" :key="index" :value="index">{{ el.title }}</option>
                    </select>
                </div>
                <div class="flex gap-5 flex-wrap">
                    <CustomButton :title="'Notirīt'" />
                    <CustomButton :title="'Filtrēt'" />
                </div>
            </form>
        </div>


        <!-- vacancies -->
        <div class="grid grid-cols-3 gap-10 justify-center items-center a">
            <Block v-for="vac in vacancies" :data="vac" :route="'vacancies'" :btnTitle="'Pieteikties'" />
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
            cities: [],
            time: [],
            pay: [],
            vacancies: [
            ],
            allvacancies: [
            ],
            search: '',
            searchlocation: -1,
        }
    },
    components: {
        Wrapper,
        TextField,
        Dropdown,
        Block,
        CustomButton,
    },
    mounted() {
        this.getVacancies()
    },
    methods: {
        async getVacancies() {
            await axios.get('api/vacancies')
                .then((response) => {
                    this.allvacancies = response.data;
                    this.allvacancies.forEach((v) => {
                        v.image_path = new URL(v.image_path, import.meta.url);
                    });
                    this.vacancies = this.allvacancies
                    this.getInfo()
                })
                .catch((err) => {
                    console.error(err);
                });
        },

        getInfo() {
            this.vacancies.forEach((v) => {
                this.cities.push({ 'title': v.location });
                this.time.push({ 'title': v.time })
                this.pay.push({ 'title': v.salary })
                this.prof.push({ 'title': v.title })
            })
        },
        searchVacancies(e) {
            //display vacancies with title equal to this.search and location equal to this.searchlocation
            e.preventDefault()
            this.vacancies = this.allvacancies
            if (this.searchlocation != -1) {
                let location = this.cities[this.searchlocation].title
                this.vacancies = this.vacancies.filter((vac) => {
                    return vac.title.toLowerCase().includes(this.search.toLowerCase()) && vac.location.toLowerCase().includes(location.toLowerCase());
                });
            } else {
                this.vacancies = this.vacancies.filter((vac) => {
                    return vac.title.toLowerCase().includes(this.search.toLowerCase());
                });
            }


        },
        filter() {
            this.vacancies = this.vacancies.filter((vac) => {

            })
        },

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