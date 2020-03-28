import Vue from "vue";
import Vuex from "vuex";
import ArticleModule from "../store/article"

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        articleMod: ArticleModule
    }
});