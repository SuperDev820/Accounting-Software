import ApiService from "@/api/api.service";
import type from './type';

const actions = {
    getSeries(context) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/series")
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_ALL_SERIES, data)
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    getSerieById(context, serieId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.get("api/v1/admin/serie/" + serieId)
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_SERIE, data)
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    createSerie(context, serieInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.post("api/v1/admin/serie/create", serieInfo)
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
    updateSerie(context, serieInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.put("api/v1/admin/serie/update", serieInfo)
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
    deleteSerie(context, serieId) {
        ApiService.setHeader();
        return new Promise((resolve) =>{
            ApiService.delete("api/v1/admin/serie/delete/" + serieId)
                .then(({data}) => {
                    context.commit(type.SET_ALL_SERIES, data)
                    toastr.success('Eliminado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
};

export default actions;