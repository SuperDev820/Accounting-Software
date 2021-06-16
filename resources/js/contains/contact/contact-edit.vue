<script>
import Layout from "../layouts/horizontal";
import appConfig from "@/app.config";
import PageHeader from "../layouts/page-header";

import { mapActions, mapGetters } from 'vuex';

import {
  required,
} from "vuelidate/lib/validators";

export default {
  page: {
    title: "Detalle de Contacto",
    meta: [{ name: "description", content: appConfig.description }]
  },
  components: { Layout, PageHeader },
  data() {
    return {
      title: "Detalle de Contacto",
      items: [
        {
          text: "Home",
          href: "/"
        },
        {
          text: "Contactos",
          href: "/contacts"
        },
        {
          text: "Detalle de Contacto",
          active: true
        }
      ],
      isError: false,
      Error: null,
      typeform: {
        name: "",
        organization: "",
        position: "",
        email: "",
        webpage: "",
        work_tel: "",
        work_tel2: "",
        home_tel: "",
        mobile: "",
        fax: "",
        work_address: "",
        home_address: "",
        file_as: "",
        observation: "",
        commission_formula: "",
        currency: "",
      },
      typesubmit: false,
      tryingToSubmit: false,
    };
  },
  validations: {
    typeform: {
      name: { required },
    }
  },
  mounted() {
    this.getContactById(this.$route.params.contactId);
  },
  computed: {
    ...mapGetters([
      'contact',
    ]),
  },
  watch: {
    contact: function () {
      this.typeform.name = this.contact.Nombre
      this.typeform.organization = this.contact.Organizacion
      this.typeform.position = this.contact.Puesto
      this.typeform.email = this.contact.Email
      this.typeform.webpage = this.contact.PaginaWeb
      this.typeform.work_tel = this.contact.TelTrabajo
      this.typeform.work_tel2 = this.contact.TelTrabajo2
      this.typeform.home_tel = this.contact.TelParticular
      this.typeform.mobile = this.contact.TelMovil
      this.typeform.fax = this.contact.Fax
      this.typeform.work_address = this.contact.DireccionTrabajo
      this.typeform.home_address = this.contact.DireccionParticular
      this.typeform.file_as = this.contact.ArchivarComo
      this.typeform.observation = this.contact.Observaciones
      this.typeform.commission_formula = this.contact.FormulaComision
      this.typeform.currency = this.contact.Moneda
    },
  },
  methods: {
    ...mapActions([
        'updateContact',
        'getContactById',
      ]),
    /**
     * Validation type submit
     */
    // eslint-disable-next-line no-unused-vars
    typeForm(e) {
      this.typesubmit = true;
      this.isError = false;
      this.Error = null;
      // stop here if form is invalid
      this.$v.$touch()
      if (this.$v.typeform.name.$error) {
        return ;
      }
      this.tryingToSubmit = true;
      return (
        this.updateContact({
            id: this.$route.params.contactId,
            name: this.typeform.name,
            organization: this.typeform.organization,
            position: this.typeform.position,
            email: this.typeform.email,
            webpage: this.typeform.webpage,
            work_tel: this.typeform.work_tel,
            work_tel2: this.typeform.work_tel2,
            home_tel: this.typeform.home_tel,
            mobile: this.typeform.mobile,
            fax: this.typeform.fax,
            work_address: this.typeform.work_address,
            home_address: this.typeform.home_address,
            file_as: this.typeform.file_as,
            observation: this.typeform.observation,
            commission_formula: this.typeform.commission_formula,
            currency: this.typeform.currency,
          })
          .then((res) => {
            this.$router.push({name: "Contacts"});
            this.typesubmit = false;
            this.tryingToSubmit = false;
          })
          .catch(error => {
            this.typesubmit = false;
            this.tryingToSubmit = false;
            this.Error = error ? error.data : "";
            this.isError = true;
          })
      );
    }
  }
};
</script>

<template>
  <Layout>
    <PageHeader :title="title" :items="items" />

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <b-alert
              v-model="isError"
              variant="danger"
              class="mt-3"
              dismissible
            >{{ Error }}</b-alert>
            <form action="#" @submit.prevent="typeForm">
              <div class="form-group">
                <label>Código: </label>
                <input
                  v-model="typeform.code"
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': typesubmit && $v.typeform.code.$error }"
                />
                <div v-if="typesubmit && $v.typeform.code.$error" class="invalid-feedback">
                  <span v-if="!$v.typeform.code.required">Este Campo es obligatorio.</span>
                </div>
              </div>

              <div class="form-group">
                <label>Nombre: </label>
                <input
                  v-model="typeform.name"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Nombre Imagen: </label>
                <input
                  v-model="typeform.image"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Título: </label>
                <input
                  v-model="typeform.title"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Dirección: </label>
                <textarea
                  v-model="typeform.direction"
                  class="form-control"
                ></textarea>
              </div>

              <div class="form-group">
                <label>Remite: </label>
                <input
                  v-model="typeform.return"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group mt-5 mb-0">
                <div>
                  <button type="submit" class="btn btn-primary" :disabled="tryingToSubmit">
                    <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Guardar
                  </button>
                  <router-link :to="{name: 'Contacts'}" class="btn btn-secondary m-l-5 ml-1">Cancelar</router-link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
