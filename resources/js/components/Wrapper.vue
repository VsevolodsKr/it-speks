<!-- This component is the base for all pages -->

<template>
    <div class="bg-gray-200 dark:bg-zinc-950 pb-16 pt-16">
        <Navigation />
        <Workspace>
            <slot></slot>
        </Workspace>
        <Footer />
    </div>
</template>


<script>
import Navigation from './base/Navigation.vue';
import Workspace from './base/Workspace.vue';
import Footer from './base/Footer.vue';
export default {
    components: {
        Navigation,
        Workspace,
        Footer,
    }
}
</script>