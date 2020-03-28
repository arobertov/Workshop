import ArticleAPI from "../api/article";

const CREATING_ARTICLE = "CREATING_ARTICLE",
    CREATING_ARTICLE_SUCCESS = "CREATING_ARTICLE_SUCCESS",
    CREATING_ARTICLE_ERROR = "CREATING_ARTICLE_ERROR",
    FETCHING_ARTICLES = "FETCHING_ARTICLES",
    FETCHING_ARTICLES_SUCCESS = "FETCHING_ARTICLES_SUCCESS",
    FETCHING_ARTICLES_ERROR = "FETCHING_ARTICLES_ERROR";

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        articles: []
    },
    getters: {
        isLoading(state) {
            return state.isLoading;
        },
        hasError(state) {
            return state.error !== null;
        },
        error(state) {
            return state.error;
        },
        hasArticles(state) {
            return state.articles.length > 0;
        },
        articles(state) {
            return state.articles;
        }
    },
    mutations: {
        [CREATING_ARTICLE](state) {
            state.isLoading = true;
            state.error = null;
        },
        [CREATING_ARTICLE_SUCCESS](state, article) {
            state.isLoading = false;
            state.error = null;
            state.articles.unshift(article);
        },
        [CREATING_ARTICLE_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
            state.articles = [];
        },
        [FETCHING_ARTICLES](state) {
            state.isLoading = true;
            state.error = null;
            state.articles = [];
        },
        [FETCHING_ARTICLES_SUCCESS](state, articles) {
            state.isLoading = false;
            state.error = null;
            state.articles = articles;
        },
        [FETCHING_ARTICLES_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
            state.articles = [];
        }
    },
    actions: {
        async create({ commit }, message) {
            commit(CREATING_ARTICLE);
            try {
                let response = await ArticleAPI.create(message);
                commit(CREATING_ARTICLE_SUCCESS, response.data);
                return response.data;
            } catch (error) {
                commit(CREATING_ARTICLE_ERROR, error);
                return null;
            }
        },
        async findAll({ commit }) {
            commit(FETCHING_ARTICLES);
            try {
                let response = await ArticleAPI.findAll();
                commit(FETCHING_ARTICLES_SUCCESS, response.data);
                return response.data;
            } catch (error) {
                commit(FETCHING_ARTICLES_ERROR, error);
                return null;
            }
        }
    }
};