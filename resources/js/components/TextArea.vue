<template>
    <textarea name="papildinformacija" col="30" rows="8" :placeholder="placeholder"
        class="ring-2 ring-gray-200 rounded-md px-4 py-3 my-4 resize-none bg-white dark:bg-slate-700"></textarea>
</template>
<script>
export default {
    props: ['placeholder'],
}
</script>