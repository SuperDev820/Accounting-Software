import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_IVA] (state, data) {
    state.all_IVA = data.all_IVA;
  },
  [type.SET_IVA] (state, data) {
    state.IVA = data.IVA;
  },
};
export default mutations;