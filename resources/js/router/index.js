import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Main from "../pages/Main.vue";
import Vacancies from "../pages/Vacancies.vue";
import News from "../pages/News.vue";
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
        path: "/vacancies",
        component: Vacancies,
    },
    {
        path: "/news",
        component: News,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
