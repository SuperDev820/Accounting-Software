import Vue from 'vue';
import Vuex from 'vuex';
import authModule from './auth';
import layoutModule from './layout';
import userModule from './user';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth: authModule,
    layout: layoutModule,
    user: userModule,
  },
});