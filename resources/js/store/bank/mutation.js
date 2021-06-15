import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_BANKS] (state, data) {
    state.banks = data.banks;
  },
  [type.SET_BANK] (state, data) {
    state.bank = data.bank;
  },
};
export default mutations;