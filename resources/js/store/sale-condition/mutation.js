import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_SALE_CONDITIONS] (state, data) {
    state.sale_conditions = data.sale_conditions;
  },
  [type.SET_SALE_CONDITION] (state, data) {
    state.sale_condition = data.sale_condition;
  },
};
export default mutations;