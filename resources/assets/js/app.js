require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import Vuex from "vuex";
import "es6-promise/auto";

Vue.use(Vuex);

const app = new Vue({
    el: "#app",
    template: "<app></app>",
    components: {
        App
    },
    router
});
