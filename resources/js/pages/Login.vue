<template>
    <Wrapper>
        <div>
            <h1 class="font-bold text-3xl text-center">Ielogoties</h1>
            <p class="text-center text-2xl mb-9">Ieeja administratoriem un moderatoriem</p>
            <form class="flex flex-col items-center" method="post">
                <TextField :type="'text'" :placeholder="'Lietotājvārds'" class="w-1/3" />
                <TextField :type="'password'" :placeholder="'Parole'" class="w-1/3" />
                <CustomButton :title="'Ielogoties'" @click="login" />
            </form>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import CustomButton from '../components/CustomButton.vue'
import TextField from '../components/TextField.vue'
export default {
    components: {
        Wrapper,
        CustomButton,
        TextField,
    },
    methods: {
        login() {
            this.$router.push('/admin');
        }
    }
}
</script>