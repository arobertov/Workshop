import Vue from "vue";
import Vuex from "vuex";
import ArticleModule from "../store/article"
import TagModule from "../store/tag"


Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        articleMod: ArticleModule,
        tagMod: TagModule,
    },
});