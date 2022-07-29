import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: 'login' */ './components/authentication/Login')
    },
    //Home
    {
        path: '/home',
        name: 'home',
        component: () => import(/* webpackChunkName: 'Home' */ './components/users/Users')
    },
    {
        path: '/reports',
        name: 'reports',
        component: () => import(/* webpackChunkName: 'Reports' */ './components/reports/Index')
    },
    {
        path: '/shifts',
        name: 'shifts',
        component: () => import(/* webpackChunkName: 'Shifts' */ './components/shifts/Index')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;
