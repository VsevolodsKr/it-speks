<template>
    <Wrapper>
        <h1 class="text-3xl font-bold text-center dark:text-gray-50 text-black">Vakances</h1>
        <div class="flex flex-wrap justify-center">
            <CustomButton :title="'Notirīt'" @click="clear" />
        </div>

        <div class="flex justify-center">
            <div
                class="max-w-6xl flex flex-col gap-10 ring-1 ring-gray-300 rounded-xl p-10 shadow-xl dark:bg-zinc-700 bg-white">
                <!-- row 1 -->
                <div>
                    <h2 class="text-xl tracking-wider underline dark:text-gray-50 text-black grid mb-4">Meklēšana</h2>
                    <form
                        class="items-center gap-5 min-[1200px]:grid grid-flow-col min-[1200px]:justify-stretch flex-wrap max-[1200px]:flex max-[1200px]:justify-center">
                        <input type="text" placeholder="Vēlamā vakance" v-model="search"
                            class="ring-2 ring-gray-200 rounded-md px-4 py-3 bg-white dark:bg-zinc-700 dark:text-gray-50 shadow-md max-[598px]:w-full">
                        <select v-model="searchlocation"
                            class="ring-2 ring-gray-200 rounded-md px-4 py-3 bg-white dark:bg-zinc-700 text-black dark:text-gray-50 shadow-md max-[598px]:w-full">
                            <option value="-1" selected>Vieta</option>
                            <option v-for="el, index in cities" :key="index" :value="index">{{ el.title }}</option>
                        </select>
                        <CustomButton :title="'Meklēt'" @click="searchVacancies" />
                    </form>
                </div>
                <!-- row 2 -->
                <div>
                    <h2 class="text-xl tracking-wider underline dark:text-gray-50 text-black mb-4">Filtri</h2>
                    <form class="flex flex-col">
                        <div
                            class="items-center gap-5 min-[1200px]:grid grid-flow-col min-[1200px]:justify-stretch flex-wrap max-[1200px]:flex max-[1200px]:justify-center">
                            <!-- amats -->
                            <select v-model="filterProf"
                                class="ring-2 ring-gray-200 rounded-md px-4 py-3 bg-white dark:bg-zinc-700 text-black dark:text-gray-50  shadow-md max-[598px]:w-full">
                                <option value="-1" class=" hidden" selected>Amats</option>
                                <option v-for="el, index in prof" :key="index" :value="index">{{ el.title }}</option>
                            </select>
                            <!-- pilseta -->
                            <select v-model="filterCities"
                                class="ring-2 ring-gray-200 rounded-md px-4 py-3 bg-white dark:bg-zinc-700 text-black dark:text-gray-50  shadow-md max-[598px]:w-full">
                                <option value="-1" class=" hidden" selected>Vieta</option>
                                <option v-for="el, index in cities" :key="index" :value="index">{{ el.title }}</option>
                            </select>
                            <!-- slodze -->
                            <select v-model="filterTime"
                                class="ring-2 ring-gray-200 rounded-md px-4 py-3 bg-white dark:bg-zinc-700 text-black dark:text-gray-50  shadow-md max-[598px]:w-full">
                                <option value="-1" class=" hidden" selected>Slodze</option>
                                <option v-for="el, index in time" :key="index" :value="index">{{ el.title }}</option>
                            </select>
                            <!-- atalgojums -->
                            <select v-model="filterPay"
                                class="ring-2 ring-gray-200 rounded-md px-4 py-3 bg-white dark:bg-zinc-700 text-black dark:text-gray-50  shadow-md max-[598px]:w-full">
                                <option value="-1" class=" hidden" selected>Atalgojums</option>
                                <option v-for="el, index in pay" :key="index" :value="index">{{ el.title }}</option>
                            </select>
                            <div>
                                <CustomButton :title="'Filtrēt'" @click="filter" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- vacancies -->
        <div class="flex justify-center">
            <div
                class="min-[1620px]:grid grid-cols-3 gap-10 max-[1620px]:flex max-[1620px]:flex-wrap max-[1620px]:justify-center">
                <Block v-for="vac in vacancies" :data="vac" :route="'vacancies'" :btnTitle="'Pieteikties'" />
            </div>

        </div>


        <!-- num -->
        <h3 class="text-gray-500 text-center font-bold"><span class="underline">{{ vacancies.length
                }}</span><br>vakances
        </h3>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
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
            filterProf: -1,
            filterCities: -1,
            filterTime: -1,
            filterPay: -1,
        }
    },
    components: {
        Wrapper,
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
        filter(e) {
            //display vacancies by using filters 'prof', 'cities', 'pay', 'time'
            e.preventDefault()
            this.vacancies = this.allvacancies
            if (this.filterProf != -1) {
                let prof = this.prof[this.filterProf].title
                this.vacancies = this.vacancies.filter((vac) => {
                    return vac.title.toLowerCase().includes(prof.toLowerCase());
                });
            }
            if (this.filterCities != -1) {
                let city = this.cities[this.filterCities].title
                this.vacancies = this.vacancies.filter((vac) => {
                    return vac.location.toLowerCase().includes(city.toLowerCase());
                });
            }
            if (this.filterPay != -1) {
                let pay = this.pay[this.filterPay].title
                this.vacancies = this.vacancies.filter((vac) => {
                    return vac.salary.toLowerCase().includes(pay.toLowerCase());
                });
            }
            if (this.filterTime != -1) {
                let time = this.time[this.filterTime].title
                this.vacancies = this.vacancies.filter((vac) => {
                    return vac.time.toLowerCase().includes(time.toLowerCase());
                });
            }

        },
        clear(e) {
            e.preventDefault()
            this.search = ''
            this.searchlocation = -1
            this.filterProf = -1
            this.filterCities = -1
            this.filterPay = -1
            this.filterTime = -1
            this.vacancies = this.allvacancies
        }
    }
}
</script>


<style scoped>
.vaca {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(28rem, 1fr));
    justify-content: center;
    align-items: center;
}
</style>