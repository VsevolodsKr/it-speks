import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Main from "../pages/Main.vue";
import About from "../pages/About.vue";
import New from "../pages/New.vue";
import Vacancy from "../pages/Vacancy.vue";

import Vacancies from "../pages/Vacancies.vue";
import News from "../pages/News.vue";
import AdminPanel from "../pages/AdminPanel.vue";
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
        path: "/vacancies",
        component: Vacancies,
    },
    {
        path: "/news",
        component: News,
    },
    {
        path: "/admin",
        component: AdminPanel,
    },
    { path: "/vacancies/:id", component: Vacancy },
    { path: "/news/:id", component: New },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
