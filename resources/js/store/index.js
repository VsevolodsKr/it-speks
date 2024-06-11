import axios from "axios";
import { createStore } from "vuex";

const store = createStore({
    state: {
        user: {
            data: {},
            token: localStorage.getItem("token"),
        },
    },
    actions: {},
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            localStorage.removeItem("token");
        },
        setUser: (state, user) => {
            // Set the user data in the state
            state.user.data = user;
        },
    },
});
export default store;
