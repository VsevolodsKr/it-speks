import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Main from "../pages/Main.vue";
import About from "../pages/About.vue";
import New from "../pages/separate-view/New.vue";
import Vacancy from "../pages/separate-view/Vacancy.vue";

import Vacancies from "../pages/Vacancies.vue";
import News from "../pages/News.vue";
import AdminPanel from "../pages/AdminPanel.vue";
const routes = [
    {
        path: "/",
        component: Main,
        meta: { guest: true },
    },
    {
        path: "/login",
        component: Login,
        meta: { guest: true },
    },
    {
        path: "/about",
        component: About,
        meta: { guest: true },
    },
    {
        path: "/vacancies",
        component: Vacancies,
        meta: { guest: true },
    },
    {
        path: "/news",
        component: News,
        meta: { guest: true },
    },
    {
        path: "/admin",
        component: AdminPanel,
        meta: { requiresAuth: true },
    },
    {
        path: "/vacancies/:id",
        component: Vacancy,
        meta: { guest: true },
    },

    { path: "/news/:id", component: New, meta: { guest: true } },
];

// Function to check if user is logged in
function loggedIn() {
    return localStorage.getItem("token");
}

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        // Redirect to login if not authenticated
        if (!loggedIn()) {
            next({
                path: "/login",
                query: { redirect: to.fullPath },
            });
        } else {
            next();
        }
        // } else if (to.matched.some((record) => record.meta.guest)) {
        //     // Redirect to dashboard if already logged in
        //     if (loggedIn()) {
        //         next({
        //             path: "/admin",
        //             query: { redirect: to.fullPath },
        //         });
        //     } else {
        //         next();
        //     }
        // }
    } else {
        next();
    }
});

export default router;
