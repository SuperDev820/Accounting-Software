import ApiService from "@/api/api.service";
import type from './type';

const actions = {
    getInvoiceTexts(context) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/invoice-texts")
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_ALL_INVOICE_TEXTS, data)
                })
                .catch(({ response }) => {
                    // context.commit(type.AUTH_LOGOUT);
                });
        });
    },
    getInvoiceTextById(context, invoiceTextId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/invoice-text/" + invoiceTextId)
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_INVOICE_TEXT, data)
                })
                .catch(({ response }) => {
                    // context.commit(type.AUTH_LOGOUT);
                });
        });
    },
    createInvoiceText(context, invoiceTextInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.post("api/v1/admin/invoice-text/create", invoiceTextInfo)
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
    updateInvoiceText(context, invoiceTextInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.put("api/v1/admin/invoice-text/update", invoiceTextInfo)
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
    deleteInvoiceText(context, invoiceTextId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.delete("api/v1/admin/invoice-text/delete/" + invoiceTextId)
                .then(({data}) => {
                    context.commit(type.SET_ALL_INVOICE_TEXTS, data)
                    toastr.success('Eliminado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
};

export default actions;