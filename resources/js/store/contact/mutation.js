import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_CONTACTS] (state, data) {
    state.contacts = data.contacts;
  },
  [type.SET_CONTACT] (state, data) {
    state.contact = data.contact;
  },
};
export default mutations;