const getters = {
    paymentMethods(state) {
        return state.payment_methods;
    },
    paymentMethod(state) {
        return state.payment_method;
    },
  };
  
  export default getters;