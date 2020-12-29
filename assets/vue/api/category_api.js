import axios from 'axios';

export default {
    createCategory(categoryFormData) {
        return axios.post("/api/category/create/new", {
            form_data: categoryFormData
        });
    },
    findAllCategories() {
        return axios.get("/api/category/index");
    },
    editCategory(categoryId,categoryFormData){
        return axios.put("/api/category/"+categoryId+"/edit",{
            form_data: categoryFormData
        })
    },
    showCategory(categoryId){
        return axios.get("/api/category/"+categoryId+"/show")
    },
    deleteCategory(categoryId){
        return axios.delete("/api/category/"+categoryId+"/delete");
    },
}
