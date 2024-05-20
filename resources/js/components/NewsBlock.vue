<template>
    <div class="ring-1 ring-gray-300 p-8 py-10 rounded-xl flex gap-44">
        <!-- col 1 -->
        <div class="flex flex-col justify-between items-start">
            <div>
                <h1 class="font-bold text-5xl mb-8">{{ title }}</h1>
                <p class="leading-loose">{{ desc }}</p>
            </div>
            <CustomButton :title="'Lasīt vairāk'" />
        </div>
        <img class="max-w-sm" src="../../images/main1.png" alt="">
    </div>
</template>

<script>
import CustomButton from './CustomButton.vue'
export default {
    props: ['title', 'desc', 'img'],
    components: {
        CustomButton,
    }
}
</script>