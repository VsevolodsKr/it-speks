<template>
<Wrapper>
    <h1 class="font-bold text-3xl text-center">Ielogoties</h1>
    <p class="text-center text-2xl -mt-12">Ieeja administratoriem un moderatoriem</p>
    <div class="flex flex-col items-center">
        <input type="text" name="Lietotajvards" placeholder="Lietotājvārds" class="w-1/3 mb-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px]" requried>
        <input type="password" name="Parole" placeholder="Parole" class="w-1/3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px] mb-16" required>
        <CustomButton :title="'Ielogoties'" />
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