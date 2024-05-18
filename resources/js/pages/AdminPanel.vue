<template>
    <Wrapper>
        <div class="text-center font-bold">
            <h1 class="text-4xl">Administracijas panelis</h1>
            <h2 class="my-5">Laipni lūgti administracijas panelī, <span class="underline">{{ username
                    }}</span>!</h2>
            <h2>Jūs esat: <span class="underline">{{ role == 1 ? "administrators" : "moderators" }}</span></h2>
        </div>
        <!-- row container -->
        <div class="flex justify-around">
            <!-- row1 -->
            <div class="flex flex-col text-center gap-3">
                <div class="flex flex-col text-center gap-3">
                    <h2 class="font-bold text-3xl">Vakances</h2>
                    <h3 class="font-bold text-lg">Rediģēt esošo</h3>
                    <Dropdown />
                    <CustomButton :title="'Rediģēt'" />
                    <CustomButton :title="'Dzēst'" :red="true" />
                </div>
                <div class="border-b-gray-200 border-b-8 my-5" />
                <div>
                    <div class="flex flex-col">
                        <h3 class="font-bold text-lg">Pievienot jaunu</h3>
                        <TextField :placeholder="'Nosaukums'" />
                        <TextField :placeholder="'Uzņēmums'" />
                        <TextField :placeholder="'Slodze'" />
                        <TextField :placeholder="'Atalgojums'" />
                        <TextField :placeholder="'Vieta'" />
                        <TextField :placeholder="'Kontakti'" />
                        <TextField :placeholder="'Apraksts'" />
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="font-bold text-lg">Bilde: <span>{{ imagename ? imagename : 'nav izvēlēta' }}</span>
                        </h3>
                        <CustomButton :title="'Pievienot bildi'" />
                        <CustomButton :title="'Apstiprināt'" />
                    </div>
                </div>
            </div>

            <!-- row2 -->
            <div class="flex flex-col text-center gap-3">
                <div class="flex flex-col text-center gap-3">
                    <h2 class="font-bold text-3xl">Aktualitātes</h2>
                    <h3 class="font-bold text-lg">Rediģēt esošo</h3>
                    <Dropdown />
                    <CustomButton :title="'Rediģēt'" />
                    <CustomButton :title="'Dzēst'" :red="true" />
                </div>
                <div class="border-b-gray-200 border-b-8 my-5" />
                <div>
                    <div class="flex flex-col">
                        <h3 class="font-bold text-lg">Pievienot jaunu</h3>
                        <TextField :placeholder="'Nosaukums'" />
                        <TextField :placeholder="'Īss apraksts'" />
                        <TextField :placeholder="'Apraksts'" />
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="font-bold text-lg">Bilde: <span>{{ imagename ? imagename : 'nav izvēlēta' }}</span>
                        </h3>
                        <CustomButton :title="'Pievienot bildi'" />
                        <CustomButton :title="'Apstiprināt'" />
                    </div>
                </div>
            </div>

            <!-- row3 -->
            <div class="flex flex-col text-center gap-3">
                <div class="flex flex-col text-center gap-3">
                    <h2 class="font-bold text-3xl">Lietotāji</h2>
                    <h3 class="font-bold text-lg">Rediģēt esošo</h3>
                    <Dropdown />
                    <CustomButton :title="'Rediģēt'" />
                    <CustomButton :title="'Dzēst'" :red="true" />
                </div>
                <div class="border-b-gray-200 border-b-8 my-5" />
                <div>
                    <div class="flex flex-col">
                        <h3 class="font-bold text-lg">Pievienot jaunu</h3>
                        <TextField :placeholder="'Vārds'" />
                        <TextField :placeholder="'Lietotājvārds'" />
                        <TextField :placeholder="'Parole'" />
                        <TextField :placeholder="'Atkārtot paroli'" />
                        <Dropdown />
                        <CustomButton :title="'Apstiprināt'" />
                    </div>
                </div>
            </div>

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

            imagename: null,
        }
    },
    components: {
        Wrapper,
        Dropdown,
        CustomButton,
        TextField,
    }
}
</script>