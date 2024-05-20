<template>
    <button
        :class="[red ? 'text-red-400 border-red-400' : 'text-calm-green border-calm-green', 'active:bg-gray-50 transition-all shadow-md hover:shadow-xl  font-bold tracking-wider text-xl border-8 py-2 px-16 rounded-xl']">{{
            title
        }}</button>
</template>

<script>
export default {
    props: ['title', 'red'],
}
</script>