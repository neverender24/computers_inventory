import Vue from 'vue'
import VueRouter from 'vue-router'

import DashboardComponent from "./../pages/dashboard"
import ComputerComponent from "../pages/computers/index.vue"

Vue.use(VueRouter)

const routes = [{
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardComponent,
    },
    {
        path: '/computers',
        name: 'computers',
        component: ComputerComponent,
    }
];

const router = new VueRouter({
    routes // short for `routes: routes`
});

export default router
