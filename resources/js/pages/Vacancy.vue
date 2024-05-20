<template>
<Wrapper>
    <div class="flex justify-around gap-10">
        <div class="w-1/2">
            <h1 class="font-bold text-4xl mb-10">Front-end developer</h1>
            <h3 class="font-bold text-2xl">Uzņēmums:</h3>
            <p class="text-2xl mb-10">SIA "Kompānija A"</p>
            <h3 class="font-bold text-2xl">Atalgojums:</h3>
            <p class="text-2xl mb-10">1000 EUR</p>
            <h3 class="font-bold text-2xl">Pilsēta:</h3>
            <p class="text-2xl mb-10">Liepāja</p>
            <h3 class="font-bold text-2xl">Apraksts:</h3>
            <p class="text-2xl mb-10">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam perferendis harum ipsam, ducimus ad eos rem commodi veritatis quia placeat sunt dolor a nulla animi magni eius doloremque sapiente libero iste maiores nam voluptate sequi. Commodi maiores facilis porro eligendi enim, eos tenetur sint? Enim, sequi porro. Velit culpa nulla incidunt iusto, asperiores obcaecati, quibusdam perspiciatis suscipit maiores ut ipsa ipsum omnis quo repudiandae laborum veritatis unde inventore impedit praesentium delectus dolore aut. Suscipit expedita maiores dolorem asperiores molestias.</p>
            <h3 class="font-bold text-2xl">Kontakti:</h3>
            <p class="text-2xl mb-10">+371 212324567 zvanot vai rakstot Whatsapp</p>
        </div>
        <div>
            <img src="../../images/main2.png">
            <h3 class="font-bold text-2xl text-center mt-10">Pieteikties vakancei<br>Front-end developer</h3>
            <form class="flex flex-col items-center" method="post">
                <input type="text" name="name" placeholder="Vārds" class="w-full my-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px]" requried>
                <input type="text" name="surname" placeholder="Uzvārds" class="w-full my-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px]" requried>
                <input type="tel" name="phone" placeholder="Tālrunis" class="w-full my-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px]" requried>
                <input type="email" name="email" placeholder="Epasts" class="w-full my-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px]" requried>
                <textarea name="comments" cols="30" rows="8" placeholder="Papildinformācija" class="w-full my-3 border-2 border-solid border-[gainsboro] rounded-md p-3 tracking-[3px] resize-none"></textarea>
                <CustomButton :title="'Pievienot dokumentu'" class="w-full mb-5"/>
                <CustomButton :title="'Pieteikties'" class="w-full"/>
            </form>
        </div>
    </div>
</Wrapper>
</template>
<script>
    import Wrapper from "../components/Wrapper.vue";
    import CustomButton from "../components/CustomButton.vue";
    export default{
        components: {
            Wrapper,
            CustomButton,
        }
    }
</script>