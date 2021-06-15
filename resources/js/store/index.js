import Vue from 'vue';
import Vuex from 'vuex';
import authModule from './auth';
import layoutModule from './layout';
import companyModule from './company';
import seriesModule from './series-invoice';
import saleConditionModule from './sale-condition';
import paymentMethodModule from './payment-method';
import bankModule from './bank';
import IVAModule from './IVA';
import invoiceTextModule from './invoice-text';
import contactModule from './contact';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth: authModule,
    layout: layoutModule,
    company: companyModule,
    series: seriesModule,
    saleCondition: saleConditionModule,
    paymentMethod: paymentMethodModule,
    bank: bankModule,
    IVA: IVAModule,
    invoiceText: invoiceTextModule,
    contact: contactModule,
  },
});