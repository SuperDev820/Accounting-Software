import ApiService from "@/api/api.service";
import type from './type';

const actions = {
    getBanks(context) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/banks")
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_ALL_BANKS, data)
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    getBankById(context, bankId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/bank/" + bankId)
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_BANK, data)
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    createBank(context, bankInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.post("api/v1/admin/bank/create", bankInfo)
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
    updateBank(context, bankInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.put("api/v1/admin/bank/update", bankInfo)
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
    deleteBank(context, bankId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.delete("api/v1/admin/bank/delete/" + bankId)
                .then(({data}) => {
                    context.commit(type.SET_ALL_BANKS, data)
                    toastr.success('Eliminado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
};

export default actions;