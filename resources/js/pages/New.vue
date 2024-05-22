<template>
    <Wrapper>
        <h1 v-if="current" class="font-bold text-3xl text-center text-black dark:text-gray-50">{{ current.title }}</h1>
        <div v-if="current">
            <img src="../../images/main2.png" class="float-left max-w-96 mr-16">
            <p class="text-justify mx-16 leading-7 indent-16 text-black dark:text-gray-50">{{ current.description }}</p>
        </div>
    </Wrapper>
</template>
<script>
import Wrapper from "../components/Wrapper.vue"
export default {
    components: {
        Wrapper,
    },
    data() {
        return {
            news: [
                {
                    id: 0,
                    title: "Aktualitāte A",
                    description: "numero uno. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius abat,suscipitnihilmodiasperiores tenetur quia vel, ducimus deserunt repellat placeat accusantium culpa aliquam facere animitemporibus quisquam ad excepturi, amet molestias? Sit nesciunt assumenda pariatur.Fugiat, ipsam.Maioresdicta error, quos consequuntur minus quam cum pariatur soluta ullam asperiores fuga minima vitaedignissimoset quibusdam quod doloribus modi, autem corrupti, quis ipsum? Quos, deserunt! Inventore voluptas veroestcum corporis dolorem beatae repudiandae in hic ex esse autem eaque temporibus dolores nisi optio nostrumtempora corrupti itaque consequuntur mollitia, nesciunt quis.Vel molestiae aspernatur minus quisquamautratione!",
                },
                {
                    id: 1,
                    title: "Aktualitāte B",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam perferendis harum ipsam, ducimus",
                },
                {
                    id: 2,
                    title: "Aktualitāte C",
                    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam perferendis harum ipsam, ducimus",
                },

            ],
            current: null,
        }
    },
    mounted() {
        const n = this.news.find(n => n.id === parseInt(this.$route.params.id));
        this.current = n;
    },
}
</script>