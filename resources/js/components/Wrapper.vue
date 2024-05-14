<!-- This component is the base for all pages -->

<template>
    <div class="bg-gray-200 pb-16">
        <Navigation />
        <Workspace>
            <slot></slot>
        </Workspace>
        <Footer />
    </div>
</template>


<script>
import Navigation from './Navigation.vue';
import Workspace from './Workspace.vue';
import Footer from './Footer.vue';
export default {
    components: {
        Navigation,
        Workspace,
        Footer,
    }
}
</script>