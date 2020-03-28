import axios from "axios";

export default {
    create(message) {
        return axios.post("article/api/new", {
            message: message
        });
    },
    findAll() {
        return axios.get("/api/index");
    }
};