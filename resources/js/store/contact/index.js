import mutations from './mutation'
import actions from './action'
import getters from './getter'
import JwtService from "@/common/jwt.service"

const defaultState = {
  contacts: [],
  contact: {}
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};
