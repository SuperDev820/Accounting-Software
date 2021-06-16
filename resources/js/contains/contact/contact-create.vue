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
    title: "Crear Contactos",
    meta: [{ name: "description", content: appConfig.description }]
  },
  components: { Layout, PageHeader },
  data() {
    return {
      title: "Crear Contactos",
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
          text: "Crear Contactos",
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
  methods: {
    ...mapActions([
        'createContact'
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
        this.createContact({
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
                <label>Nombre: </label>
                <input
                  v-model="typeform.name"
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': typesubmit && $v.typeform.name.$error }"
                />
                <div v-if="typesubmit && $v.typeform.name.$error" class="invalid-feedback">
                  <span v-if="!$v.typeform.name.required">Este Campo es obligatorio.</span>
                </div>
              </div>

              <div class="form-group">
                <label>Organización: </label>
                <input
                  v-model="typeform.organization"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Archivar Como: </label>
                <input
                  v-model="typeform.file_as"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Puesto: </label>
                <input
                  v-model="typeform.position"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Email: </label>
                <input
                  v-model="typeform.email"
                  type="email"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Página Web: </label>
                <input
                  v-model="typeform.webpage"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Tel. Trabajo: </label>
                <input
                  v-model="typeform.work_tel"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Tel. Trabajo 2: </label>
                <input
                  v-model="typeform.work_tel2"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Tel. Particular: </label>
                <input
                  v-model="typeform.home_tel"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Móvil: </label>
                <input
                  v-model="typeform.mobile"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Fax: </label>
                <input
                  v-model="typeform.fax"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Dirección: </label>
                <textarea
                  v-model="typeform.work_address"
                  class="form-control"
                ></textarea>
              </div>

              <div class="form-group">
                <label>Dirección Particular: </label>
                <textarea
                  v-model="typeform.home_address"
                  class="form-control"
                ></textarea>
              </div>

              <div class="form-group">
                <label>Observaciones: </label>
                <textarea
                  v-model="typeform.observation"
                  class="form-control"
                ></textarea>
              </div>

              <div class="form-group">
                <label>Fórmula Comisión: </label>
                <input
                  v-model="typeform.commission_formula"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <label>Moneda: </label>
                <input
                  v-model="typeform.currency"
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
                  <button type="reset" class="btn btn-warning m-l-5 ml-1">Vaciar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
