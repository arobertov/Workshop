/**
 * admin panel home
 * /admin
 * name: admin_panel
 * component: AdminPanel
 *
 * admin panel articles
 * /admin/article/index
 * name: admin_article_index
 * component:AdminArticleIndex
 *
 * ap article new
 * /admin/article/new
 * name: admin_article_new
 * component:AdminArticleNew
 *
 * ap article show
 * path: "/admin/article/:id/show"
 * name: "admin_article_show"
 * component: AdminArticleShow
 *
 * ap article edit
 * path: "/admin/article/:id/edit"
 * name: admin_article_edit
 * component:AdminArticleEdit
 *
 * ap article delete
 * path: "/admin/article/:id/delete"
 * name: admin_article_delete
 * component:AdminArticleDelete
 *
 */

import Vue from "vue";
import VueRouter from "vue-router";
import AdminPanel from "../views/admin-panel/Admin-home";
import AdminArticleNew from "../views/article/Article-new";
import AdminArticleIndex from "../views/article/Article-index";
import AdminArticleShow from "../views/article/Article-show";
import AdminArticleEdit from "../views/article/Article-edit";
import AdminArticleDelete from "../views/article/Article-delete"
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
            path: "/admin/article/:id/show",
            name: "admin_article_show",
            component: AdminArticleShow
        },
        {
            path: "/admin/article/new",
            name: "admin_article_new",
            component: AdminArticleNew
        },
        {
            path: "/admin/article/:id/edit",
            name: "admin_article_edit",
            component:AdminArticleEdit,
        },
        {
            path: "/admin/article/:id/delete",
            name: "admin_article_delete",
            component:AdminArticleDelete,
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

