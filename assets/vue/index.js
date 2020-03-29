import Vue from "vue";
import App from "./views/admin-panel/Aside-nav";
import router from "./router";
import store from "./store";
import moment from 'moment';

//--------------  datetime filer  --------------------- //
Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).locale('bg').format('LLLL')
    }
});




new Vue({
    components: {
        App
    },
    template: "<App/>",
    router,
    store
}).$mount("#app");