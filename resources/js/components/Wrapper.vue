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


<script setup>
// Requests
import axios from "axios";

// Store access
import { useStore } from "vuex";


const store = useStore();

// Define custom event, to announce completion
const emit = defineEmits(['userFetched']);

// If user data is not in store
if (!Object.keys(store.state.user.data).length) {

    // Get token of current user
    const token = localStorage.getItem("token");

    // Send request to get user data providing token
    axios.get("api/user", {
        headers: { Authorization: `Bearer ${token}` },
    }).then((response) => {

        // If successful => save the received data in store
        store.commit("setUser", response.data);

        // Announce that request is completed
        emit('userFetched');
    }).catch(error => {

        // If failed => display error
        console.error(error)
    })
}

</script>


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
