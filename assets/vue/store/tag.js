import TagApi from '../api/tag_api';

export default {
    namespaced: true,
    state: {
        tags : 10
    },
    mutations: {
        increment: state => state.tags++,
        decrement: state => state.tags--
    }
}