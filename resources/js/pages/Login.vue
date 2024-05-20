<template>
<Wrapper>
    <div>
        <h1 class="font-bold text-3xl text-center">Ielogoties</h1>
        <p class="text-center text-2xl mb-9">Ieeja administratoriem un moderatoriem</p>
        <form class="flex flex-col items-center" method="post">
            <input type="text" name="Lietotajvards" placeholder="Lietotājvārds" class="w-1/3 mb-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px]" requried>
            <input type="password" name="Parole" placeholder="Parole" class="w-1/3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px] mb-16" required>
            <CustomButton :title="'Ielogoties'" />
        </form>
    </div>
</Wrapper>
</template>
<script>
import Wrapper from '../components/Wrapper.vue'
import CustomButton from '../components/CustomButton.vue'
export default {
    components: {
        Wrapper,
        CustomButton,
    }
}
</script>