import Vuex from 'vuex'
import Vue from 'vue'
import auth from './modules/auth/index';
import { LOADING_SPINNER_SHOW_MUTATION } from './storeconstants';

Vue.use(Vuex)
const store = new  Vuex.Store({
    modules: {
        auth,
    },
    state() {
        return {
            showLoading: false,
        };
    },
    mutations: {
        [LOADING_SPINNER_SHOW_MUTATION](state, payload) {
            state.showLoading = payload;
        },
    },
});

export default store;
