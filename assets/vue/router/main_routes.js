import Vue from "vue";
import VueRouter from "vue-router";
import article_router from "./article_router";


Vue.use(VueRouter);

const baseRoutes = [
    ... article_router
];

const routes = baseRoutes.concat(article_router);
export default new VueRouter({
    mode: "history",
    routes:routes,
});