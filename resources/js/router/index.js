import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Main from "../pages/Main.vue";
import About from "../pages/About.vue";
import New from "../pages/New.vue";
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
    },
    {
        path: "/new",
        component: New,
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;