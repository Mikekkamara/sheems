import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        /**
         * Auth
         */
        {
            path: '/login',
            component: () => import(/* webpackChunkName: 'Login' */ './components/auth/Login'),
            props: true
        },
        {
            path: '/home',
            name: 'home',
            props: true,
            component: () => import(/* webpackChunkName: 'Home' */ './components/users/Index'),
            children: [
                {
                    path: 'all',
                    name: 'homeAll',
                    component: () => import(/* webpackChunkName: 'TheTableHome' */ './components/users/TheTable')
                },
                {
                    path: 'clock',
                    name: 'clock',
                    props: true,
                    component: () => import(/* webpackChunkName: 'Clock' */ './components/users/Clock'),
                    children: [
                        {
                            path: ':slug',
                            name: 'clockUser',
                            props: true,
                            component: () => import(/* webpackChunkName: 'ClockUser' */ './components/users/User')
                        }
                    ]
                }
            ]
        }
    ],
});
