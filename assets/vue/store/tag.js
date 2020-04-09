import TagApi from '../api/tag_api';

export default {
    namespaced: true,
    state: {
        tags : [
            {id:1,name:"Tag1"},
            {id:2,name:"Tag2"},
            {id:3,name:"Tag3"},
            {id:4,name:"Tag4"},
        ]
    },
    getters:{
        tags(state){
            return state.tags;
        }
    }
}