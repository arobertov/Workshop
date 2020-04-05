import CategoryApi from "../api/category_api";

export default {
    namespaced: true,
    state: {
        category: {
            id: '',
            name: '',
        },
        categories:[]
    },
    getters: {
        getCategoryId(state) {
            return state.id;
        },
        getCategoryName(state) {
            return state.name;
        },
        getCategories(state){
            return state.categories;
        }
    },
    mutations: {
        updateCategoryId(state, categoryId) {
            state.id = categoryId;
        },
        updateCategoryName(state, categoryName) {
            state.name = categoryName;
        },
        updateCategories(state,categories){
            state.categories = categories;
        }
    },
    actions:{
        async createCategory({commit},categoryFormData){
            try{
             let response = await CategoryApi.createCategory(categoryFormData);
             commit('updateCategoryId',categoryFormData.id);
             commit(' updateCategoryName',categoryFormData.name);
             return response.data;
            } catch (e) {
                return e;
            }
        },
        async findAllCategories({commit}){
            try{
                let response = await CategoryApi.findAllCategories();
                commit('updateCategories', response.data);
                return response.data;
            } catch (e) {
                return e;
            }
        }

    }
}
