import axios from 'axios';

export default {
    createCategory(categoryFormData) {
        return axios.post("/api/category/create/new", {
            form_data: categoryFormData
        });
    },
    findAllCategories() {
        return axios.get("/api/category/index");
    }
}
