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
      title: "Crear Forma de Pago",
      items: [
        {
          text: "Home",
          href: "/"
        },
        {
          text: "Formas de Pago",
          href: "/settings/payment-methods"
        },
        {
          text: "Crear Formas de Pago",
          active: true
        }
      ],
      isError: false,
      Error: null,
      typeform: {
        name: "",
        operation_values: "",
        no_fractions: "",
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
        'createPaymentMethod'
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
        this.createPaymentMethod({
            name: this.typeform.name,
            operation_values: this.typeform.operation_values,
            no_fractions: this.typeform.no_fractions,
          })
          .then((res) => {
            this.$router.push({name: "PaymentMethods"});
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

              <div class="form-group col-8">
                <label>Valor Operaciones: </label>
                <input
                  v-model="typeform.operation_values"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-8">
                <label>Nº Fracciones: </label>
                <input
                  v-model="typeform.no_fractions"
                  type="number"
                  class="form-control"
                />
              </div>

              <div class="form-group col-12 mt-5 mb-0">
                <div>
                  <button type="submit" class="btn btn-primary" :disabled="tryingToSubmit">
                    <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Guardar
                  </button>
                  <router-link :to="{name: 'PaymentMethods'}" class="btn btn-secondary m-l-5 ml-1">Cancelar</router-link>
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
