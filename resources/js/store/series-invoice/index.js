import mutations from './mutation'
import actions from './action'
import getters from './getter'
import JwtService from "@/common/jwt.service"

const defaultState = {
  series: [],
  serie: {}
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};
