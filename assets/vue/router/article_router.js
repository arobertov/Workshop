
import AdminPanel from "../views/admin-panel/Admin-home";
import AdminArticleNew from "../views/article/Article-new";
import AdminArticleIndex from "../views/article/Article-index";
import AdminArticleShow from "../views/article/Article-show";
import AdminArticleEdit from "../views/article/Article-edit";




export default [
        {
            path: "/админ",
            name: "admin_panel",
            component: AdminPanel
        },
        {
            path: "/админ/статии/всички_статии",
            name: "admin_article_index",
            component: AdminArticleIndex
        },
        {
            path: "/админ/статии/:id/преглед",
            name: "admin_article_show",
            component: AdminArticleShow
        },
        {
            path: "/админ/статии/създай_нова_статия",
            name: "admin_article_new",
            component: AdminArticleNew
        },
        {
            path: "/админ/статии/:id/редактирай",
            name: "admin_article_edit",
            component:AdminArticleEdit,
        },
        {
            path: "*",
            redirect: "/"
        }
    ]

