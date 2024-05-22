<template>
    <input :type="type" :placeholder="placeholder"
        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 bg-white dark:bg-slate-700">
</template>
<script>
export default {
    props: ['type', 'placeholder'],
}
</script>