import Vue from 'vue'
import VueRouter from 'vue-router'

import general from './general';
import doctor from './doctor';
import quizze from  './quizze';
import transaction from './transaction'

Vue.use(VueRouter);

const baseRoute = [];
const routes = baseRoute.concat(general, doctor, quizze, transaction);


// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes,
    mode: 'history',
});
export  default router;



