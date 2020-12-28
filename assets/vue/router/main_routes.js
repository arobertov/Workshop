import Vue from "vue";
import VueRouter from "vue-router";
import article_router from "./article_router";
import category_router from "./category_router";


Vue.use(VueRouter);

const baseRoutes = [];

const routes = baseRoutes.concat(article_router).concat(category_router);
console.log(routes);
export default new VueRouter({
    mode: "history",
    routes:routes,
});