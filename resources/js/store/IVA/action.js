import ApiService from "@/api/api.service";
import type from './type';

const actions = {
    getAllIVA(context) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/all-IVA")
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_ALL_IVA, data)
                })
                .catch(({ response }) => {
                    // context.commit(type.AUTH_LOGOUT);
                });
        });
    },
    getIVAById(context, IVAId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/IVA/" + IVAId)
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_IVA, data)
                })
                .catch(({ response }) => {
                    // context.commit(type.AUTH_LOGOUT);
                });
        });
    },
    createIVA(context, IVAInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.post("api/v1/admin/IVA/create", IVAInfo)
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
    updateIVA(context, IVAInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.put("api/v1/admin/IVA/update", IVAInfo)
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
    deleteIVA(context, IVAId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.delete("api/v1/admin/IVA/delete/" + IVAId)
                .then(({data}) => {
                    context.commit(type.SET_ALL_IVA, data)
                    toastr.success('Eliminado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
};

export default actions;