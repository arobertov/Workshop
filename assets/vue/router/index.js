/**
 * admin panel home
 * /admin
 * name: admin_panel
 * component: AdminPanel
 * admin panel articles
 * /admin/article/index
 * name: admin_article_index
 * component:AdminArticleIndex
 * ap article new
 * /admin/article/new
 * name: admin_article_new
 * component:AdminArticleNew
 * ap article edit
 * /admin/article/edit:articleId
 * name: admin_article_edit
 * component:AdminArticleEdit
 * ap article delete
 * /admin/article/delete:articleId
 * name: admin_article_delete
 * component:AdminArticleDelete
 *
 */

import Vue from "vue";
import VueRouter from "vue-router";
import AdminPanel from "../views/admin-panel/Admin-home";
import NewArticle from "../views/article/Article-new";
import AdminArticleIndex from "../views/article/Article-index";
import TagIndex from "../views/tag/TagIndex";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/admin",
            name: "admin_panel",
            component: AdminPanel
        },
        {
            path: "/admin/article/index",
            name: "admin_article_index",
            component: AdminArticleIndex
        },
        {
            path:"/articles/new-article",
            component: NewArticle
        },
        {
            path:"/tag/list-all",
            component: TagIndex
        },
        {
            path: "*",
            redirect: "/"
        }
    ]
});

