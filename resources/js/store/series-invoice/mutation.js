import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_SERIES] (state, data) {
    state.series = data.series;
  },
  [type.SET_SERIE] (state, data) {
    state.serie = data.serie;
  },
};
export default mutations;