import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_COMPANIES] (state, data) {
    state.companies = data.companies;
  },
  [type.SET_COMPANY] (state, data) {
    state.company = data.company;
  },
};
export default mutations;