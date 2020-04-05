import axios from "axios";

export default {
    create(articleFormData) {
        return axios.post("/api/create/new", {
            form_data: articleFormData
        });
    },
    findAll() {
        return axios.get("/api/index");
    }
};