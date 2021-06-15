import type from './type'
import JwtService from '@/common/jwt.service'

const mutations = {
  [type.SET_ALL_INVOICE_TEXTS] (state, data) {
    state.invoice_texts = data.invoice_texts;
  },
  [type.SET_INVOICE_TEXT] (state, data) {
    state.invoice_text = data.invoice_text;
  },
};
export default mutations;