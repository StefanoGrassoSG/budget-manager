import { createRouter, createWebHistory } from 'vue-router';
import { store } from '../src/store.js'

import HomePage from './pages/HomePage.vue';
import RegisterPage from './pages/RegisterPage.vue';
import LoginPage from './pages/LoginPage.vue';
import DashboardPage from './pages/DashboardPage.vue';
import TransactionsPage from './pages/TransactionsPage.vue';


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            components: {
                public: HomePage,
            },
            store
        },
        {
            path: '/admin',
            name: 'admin',
            components: {
                admin: DashboardPage
            },
            store
        },
        {
            path: '/admin/transactions',
            name: 'transactions',
            components: {
                admin: TransactionsPage
            },
            store
        },
        {
            path: '/register',
            name: 'register',
            components: {
                public: RegisterPage,
            },
        },
        {
            path: '/login',
            name: 'login',
            components: {
                public: LoginPage,
            },
        },
        {
           // path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound
        },

    ]   
});

router.beforeEach((to, from, next) => {
    // Rimuovi eventuali classi della rotta precedente dal body
    document.body.classList.remove(`route-${from.name}`);
    
    // Aggiungi la classe basata sulla rotta attuale al body
    document.body.classList.add(`route-${to.name}`);
    
    next();
});

export { router };