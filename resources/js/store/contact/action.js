import ApiService from "@/api/api.service";
import type from './type';

const actions = {
    getContacts(context) {
        ApiService.setHeader();
        return new Promise((resolve, reject) =>{
            ApiService.get("api/v1/admin/contacts")
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_ALL_CONTACTS, data)
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    getContactById(context, contactId) {
        ApiService.setHeader();
        return new Promise((resolve, reject) =>{
            ApiService.get("api/v1/admin/contact/" + contactId)
                .then(({data}) => {
                    console.log(data);
                    context.commit(type.SET_CONTACT, data)
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    createContact(context, contactInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.post("api/v1/admin/contact/create", contactInfo)
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
    updateContact(context, contactInfo) {
        ApiService.setHeader();
        return new Promise((resolve, reject) => {
            ApiService.put("api/v1/admin/contact/update", contactInfo)
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
    deleteContact(context, contactId) {
        ApiService.setHeader();
        return new Promise((resolve, reject) =>{
            ApiService.delete("api/v1/admin/contact/delete/" + contactId)
                .then(({data}) => {
                    context.commit(type.SET_ALL_CONTACTS, data)
                    toastr.success('Eliminado Correctamente', {timeout: 1000,closeButton: true,closeMethod: 'fadeOut',closeDuration: 300});
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
};

export default actions;