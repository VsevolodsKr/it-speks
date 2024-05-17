<template>
    <div class="ring-1 ring-gray-200 rounded-xl py-5 px-8 flex flex-col justify-between items-center gap-5">
        <h1 class="text-2xl font-bold underline">{{ title }}</h1>
        <div class="w-96 h-48 overflow-hidden rounded-md">
            <img src="../../images/main2.png">
        </div>
        <p class="italic text-gray-600">{{ desc }}</p>
        <CustomButton :title="btnTitle" />
    </div>
</template>

<script>
import CustomButton from './CustomButton.vue';
export default {
    props: ['title', 'desc', 'imgsrc', 'btnTitle'],
    components: {
        CustomButton,
    }
}
</script>