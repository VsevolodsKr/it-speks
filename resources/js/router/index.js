import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Main from "../pages/Main.vue";
import About from "../pages/About.vue";
const routes = [
    {
        path: "/",
        component: Main,
    },
    {
        path: "/login",
        component: Login,
    },
    {
        path: "/about",
        component: About,
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;