import ArticleAPI from "../api/article_api";
import { getField, updateField } from 'vuex-map-fields';

const
    CREATING_ARTICLE = "CREATING_ARTICLE",
    CREATING_ARTICLE_SUCCESS = "CREATING_ARTICLE_SUCCESS",
    CREATING_ARTICLE_ERROR = "CREATING_ARTICLE_ERROR",
    EDITING_ARTICLE = "EDITING_ARTICLE",
    EDITING_ARTICLE_SUCCESS="EDITING_ARTICLE_SUCCESS",
    DELETING_ARTICLE = "DELETING_ARTICLE",
    FETCHING_ARTICLES = "FETCHING_ARTICLES",
    FETCHING_ARTICLE = "FETCHING_ARTICLE",
    FETCHING_ARTICLE_SUCCESS = "FETCHING_ARTICLE_SUCCESS",
    FETCHING_ARTICLES_SUCCESS = "FETCHING_ARTICLES_SUCCESS",
    FETCHING_ARTICLES_ERROR = "FETCHING_ARTICLES_ERROR",
    FETCHING_ARTICLE_ERROR = "FETCHING_ARTICLE_ERROR",
    FETCHING_FORM_ERRORS = "FETCHING_FORM_ERRORS";

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        formErrors:{
            title: '' ,
            contents: ''
        },
        articles: [],
        article:{
            id: undefined ,
            title: '',
            contents: '',
            tags: [],
            category: '',
            isPublished:undefined,
        },
        responseData:'',
    },
    getters: {
        getResponseData(state){
            return state.responseData;
        },
        getArticleField(state){
            return getField(state.article)
        },
        isLoading(state) {
            return state.isLoading;
        },
        hasError(state) {
            return state.error !== null;
        },
        formErrors(state){
            return state.formErrors;
        },
        error(state) {
            return state.error;
        },
        hasArticles(state) {
            return state.articles.length > 0;
        },
        articles(state) {
            return state.articles;
        },
        article(state){
            return state.article;
        }
    },
    mutations: {
        updateArticleField(state, field) {
            updateField(state.article, field);
        },
        [CREATING_ARTICLE](state,catId){
            state.article = {};
            state.article.tags = [];
            state.article.category = catId;
            state.article.isPublished = undefined;
            state.isLoading = false;
            state.error = null;
        },
        [CREATING_ARTICLE_SUCCESS](state, data) {
            state.isLoading = false;
            state.error = null;
            state.responseData = data;
            if(data !== null) state.article = data;
            state.articles.unshift(state.article);
        },
        [CREATING_ARTICLE_ERROR](state, error) {
            state.isLoading = false;
            state.formErrors.title = '';
            state.formErrors.contents = '';
            state.error = error;
        },
        [EDITING_ARTICLE](state,tags){
           state.isLoading = false;
           state.formErrors = {};
           state.error = null;
           state.article.tags = tags;

        },
        [EDITING_ARTICLE_SUCCESS](state,articleId){
            state.articles.forEach(function (e) {
                if(e.id === articleId){
                    state.articles.splice(e,1,state.article);
                }
            })
        },
        [DELETING_ARTICLE](state,articleId){
            state.articles.forEach(function (e) {
                if(e.id===articleId){
                    state.articles.splice(e,1);
                }
            });
        },
        [FETCHING_ARTICLES](state) {
            if(state.articles.length===0){
                state.isLoading = true;
            }
            state.error = null;
        },
        [FETCHING_ARTICLES_SUCCESS](state, articles) {
            state.isLoading = false;
            state.error = null;
            state.articles = articles;
        },
        [FETCHING_ARTICLE](state) {
            state.isLoading = true;
            state.error = null;
            state.article = {};
            state.article.tags = [];
        },
        [FETCHING_ARTICLE_SUCCESS](state, article) {
            state.isLoading = false;
            state.error = null;
            state.article = article;

        },
        [FETCHING_ARTICLE_ERROR](state,error){
            state.isLoading = false;
            state.error = error;
            state.article = {};
        },
        [FETCHING_ARTICLES_ERROR](state, error) {
            state.isLoading = false;
            state.error = error;
        },
        [FETCHING_FORM_ERRORS](state,error){
            state.error = null;
            state.formErrors = error;
        }
    },
    actions: {
        async create({ commit }, articleFormData) {
            try {
                let response = await ArticleAPI.create(articleFormData);
                commit(CREATING_ARTICLE_SUCCESS, response.data);
                return response.data;
            } catch (error) {
                let errorData = error.response.data;
                if(errorData.hasOwnProperty('title') || errorData.hasOwnProperty('contents')){
                    commit(FETCHING_FORM_ERRORS,errorData);
                } else {
                    commit(CREATING_ARTICLE_ERROR, errorData);
                }
                return null;
            }
        },
        async findArticle({commit},articleId){
            commit(FETCHING_ARTICLE);
            try{
                let response = await ArticleAPI.show(articleId);
                commit(FETCHING_ARTICLE_SUCCESS,response.data)
                return response.data;
            }catch (error) {
                commit(FETCHING_ARTICLE_ERROR,error);
                return null;
            }
        },
        async edit({commit},articleData){
            try {
                let response = await ArticleAPI.edit(articleData.articleId,articleData.articleFormData);
                commit(EDITING_ARTICLE_SUCCESS,response.data)
                return response.data;
            } catch (error) {
                let errorData = error.response.data;
                if(errorData.hasOwnProperty('title') || errorData.hasOwnProperty('contents')){
                    commit(FETCHING_FORM_ERRORS,errorData);
                } else {
                    commit(CREATING_ARTICLE_ERROR, errorData);
                }
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
        },
        async deleteArticle({commit},articleId){
            try{
                commit(DELETING_ARTICLE,articleId);
                let response = await ArticleAPI.delete(articleId);
                return response.data;
            } catch (error) {
                commit(FETCHING_ARTICLES_ERROR, error);
                return null;
            }


        }
    }
};

