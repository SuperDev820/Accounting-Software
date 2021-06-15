import Vue from 'vue';
import Vuex from 'vuex';
import authModule from './auth';
import layoutModule from './layout';
import companyModule from './company';
import seriesModule from './series-invoice';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth: authModule,
    layout: layoutModule,
    company: companyModule,
    series: seriesModule,
  },
});