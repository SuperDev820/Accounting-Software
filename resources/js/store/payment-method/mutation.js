import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_PAYMENT_METHODS] (state, data) {
    state.payment_methods = data.payment_methods;
  },
  [type.SET_PAYMENT_METHOD] (state, data) {
    state.payment_method = data.payment_method;
  },
};
export default mutations;