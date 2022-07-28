import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: 'login' */ './components/Authentication/Login')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;
