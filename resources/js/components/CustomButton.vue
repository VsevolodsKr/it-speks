<template>
    <button
        class="active:bg-gray-50 transition-all shadow-md hover:shadow-xl text-calm-green border-calm-green font-bold tracking-wider text-xl border-8 py-2 px-16 rounded-xl">{{
            title
        }}</button>
</template>

<script>
export default {
    props: ['title'],
}
</script>