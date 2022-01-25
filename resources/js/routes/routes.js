import { createRouter, createWebHistory } from 'vue-router';

import GetproductList from '../components/products/Index.vue';
import CreateProduct from '../components/products/Create.vue';
import EditProduct from '../components/products/Edit.vue';
import viewProduct from '../components/products/Show.vue';

const routeList = [

    {
        path: '/admin',
        component: GetproductList,
    },

    {
        path: '/admin/create-product',
        component: CreateProduct,
    },

    {
        path: '/admin/edit-product',
        component: EditProduct,
    },

    {
        path: '/admin/view-product',
        component: viewProduct,
    },


]


const baseRoutes = []
const routes = baseRoutes.concat(routeList);
const router = createRouter({
    mode: 'history',
    history: createWebHistory(),
    routes, // short for `routes: routes`
    linkActiveClass: 'active'
})


export default router;