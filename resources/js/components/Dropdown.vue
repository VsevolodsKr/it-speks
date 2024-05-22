<template>
    <select
        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-slate-700 text-black dark:text-gray-50">
        <option v-for="el, index in elements" :key="index" :value="index">{{ el.title }}</option>
    </select>
</template>
<script>
export default {
    props: ['elements']
}
</script>