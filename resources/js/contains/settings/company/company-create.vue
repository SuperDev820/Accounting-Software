<script>
import Layout from "../../layouts/horizontal";
import appConfig from "@/app.config";
import PageHeader from "../../layouts/page-header";

import { mapActions, mapGetters } from 'vuex';

import {
  required,
} from "vuelidate/lib/validators";

export default {
  page: {
    title: "Crear Empresas",
    meta: [{ name: "description", content: appConfig.description }]
  },
  components: { Layout, PageHeader },
  data() {
    return {
      title: "Crear Empresas",
      items: [
        {
          text: "Home",
          href: "/"
        },
        {
          text: "Empresas",
          href: "/settings/companies"
        },
        {
          text: "Crear Empresas",
          active: true
        }
      ],
      isError: false,
      Error: null,
      typeform: {
        code: "",
        name: "",
        image: "",
        direction: "",
        title: "",
        return: "",
      },
      typesubmit: false,
      tryingToSubmit: false,
    };
  },
  validations: {
    typeform: {
      code: { required },
    }
  },
  methods: {
    ...mapActions([
        'createCompany'
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
      if (this.$v.typeform.code.$error) {
        return ;
      }
      this.tryingToSubmit = true;
      return (
        this.createCompany({
            IdEmpresa: this.typeform.code,
            name: this.typeform.name,
            image: this.typeform.image,
            title: this.typeform.title,
            direction: this.typeform.direction,
            return: this.typeform.return,
          })
          .then((res) => {
            this.$router.push({name: "Companies"});
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
            <form action="#" @submit.prevent="typeForm" class="row">
              <div class="form-group col-8">
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

              <div class="form-group col-8">
                <label>Nombre: </label>
                <input
                  v-model="typeform.name"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-8">
                <label>Nombre Imagen: </label>
                <input
                  v-model="typeform.image"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-8">
                <label>Título: </label>
                <input
                  v-model="typeform.title"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-8">
                <label>Dirección: </label>
                <textarea
                  v-model="typeform.direction"
                  class="form-control"
                ></textarea>
              </div>

              <div class="form-group col-8">
                <label>Remite: </label>
                <input
                  v-model="typeform.return"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-12 mt-5 mb-0">
                <div>
                  <button type="submit" class="btn btn-primary" :disabled="tryingToSubmit">
                    <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Guardar
                  </button>
                  <router-link to="/settings/companies" class="btn btn-secondary m-l-5 ml-1">Cancelar</router-link>
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
