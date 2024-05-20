<template>
    <input :type="type" :placeholder="placeholder" class="ring-2 text-xl ring-gray-200 rounded-md px-4 py-3 my-4">
</template>
<script>
export default {
    props: ['type', 'placeholder'],
}
</script>