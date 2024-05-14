import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Main from "../pages/Main.vue";
const routes = [
    {
        path: "/",
        component: Main,
    },
    {
        path: "/login",
        component: Login,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;