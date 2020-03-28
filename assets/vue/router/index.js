import Vue from "vue";
import VueRouter from "vue-router";
import Adm from "../views/admin-panel/Admin-home";
import NewArticle from "../views/article/Article-new";
import ArticleIndex from "../views/article/Article-index";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/admin", component: Adm },
        { path:"/article/list-all", component: ArticleIndex},
        { path:"/article/new-article", component: NewArticle},
        { path: "*", redirect: "/" }
    ]
});