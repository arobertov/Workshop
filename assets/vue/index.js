import Vue from "vue";
import App from "./views/admin-panel/Aside-nav";
import router from "./router";
import store from "./store";

new Vue({
    components: { App },
    template: "<App/>",
    router,
    store
}).$mount("#app");