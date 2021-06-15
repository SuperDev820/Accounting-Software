import ApiService from "@/api/api.service";
import type from './type';

const actions = {
    getPaymentMethods(context) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/payment-methods")
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_ALL_PAYMENT_METHODS, data)
                })
                .catch(({ response }) => {
                    // context.commit(type.AUTH_LOGOUT);
                });
        });
    },
    getPaymentMethodById(context, paymentMethodId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/payment-method/" + paymentMethodId)
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_PAYMENT_METHOD, data)
                })
                .catch(({ response }) => {
                    // context.commit(type.AUTH_LOGOUT);
                });
        });
    },
    createPaymentMethod(context, paymentMethodInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.post("api/v1/admin/payment-method/create", paymentMethodInfo)
                .then((data) => {
                    resolve(data);
                    toastr.success('Creado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({response, status}) => {
                    console.log(response);
                    reject(response);
                });
        });
    },
    updatePaymentMethod(context, paymentMethodInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.put("api/v1/admin/payment-method/update", paymentMethodInfo)
                .then((data) => {
                    resolve(data);
                    toastr.success('Actualizado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({response, status}) => {
                    console.log(response);
                    reject(response);
                });
        });
    },
    deletePaymentMethod(context, paymentMethodId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.delete("api/v1/admin/payment-method/delete/" + paymentMethodId)
                .then(({data}) => {
                    context.commit(type.SET_ALL_PAYMENT_METHODS, data)
                    toastr.success('Eliminado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
};

export default actions;