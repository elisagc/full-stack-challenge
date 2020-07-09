require("./bootstrap");
window.Vue = require("vue");

import Vue from "vue";
import VueMaterial from "vue-material";
import "vue-material/dist/vue-material.min.css";
import Vuex from "vuex";

Vue.use(VueMaterial);
Vue.use(Vuex);
Vue.component("Tasks", require("./components/Tasks.vue").default);

const store = new Vuex.Store({
    state: {
        isOpen: false
    },
    mutations: {
        isOpen: function(state) {
            state.isOpen = !this.isOpen;
        }
    }
});

const app = new Vue({
    el: "#app",
    store
});
