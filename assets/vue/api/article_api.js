import axios from "axios";

export default {
    create(articleFormData) {
        console.log(articleFormData);
        return axios.post("/api/article/new", {
            form_data: articleFormData
        });
    },
    edit(articleId,articleFormData){
        return axios.post("/api/article/"+articleId+"/edit",{
            form_data: articleFormData
        })
    },
    show(articleId){
        return axios.get("/api/article/"+articleId+"/show")
    },
    delete(articleId){
        return axios.delete("/api/article/"+articleId+"/delete");
    },
    findAll() {
        return axios.get("/api/article/index");
    }
};