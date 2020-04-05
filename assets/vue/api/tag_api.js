import axios from 'axios';

export default {
    create(tagFormData){
        return axios.post('/api/tag/new',{
            tagFormData : tagFormData
        })
    },
    findAll(){
        return axios.get('/api/tag/index')
    }
}