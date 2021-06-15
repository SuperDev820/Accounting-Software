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
    title: "Detalle de Empresa",
    meta: [{ name: "description", content: appConfig.description }]
  },
  components: { Layout, PageHeader },
  data() {
    return {
      title: "Detalle de Empresa",
      items: [
        {
          text: "Home",
          href: "/"
        },
        {
          text: "Empresas",
          href: "/settings/invoice-texts"
        },
        {
          text: "Detalle de Empresa",
          active: true
        }
      ],
      isError: false,
      Error: null,
      typeform: {
        name: "",
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
    this.getInvoiceTextById(this.$route.params.invoiceTextId);
  },
  computed: {
    ...mapGetters([
      'invoiceText',
    ]),
  },
  watch: {
    invoiceText: function () {
      this.typeform.name = this.invoiceText.Descripcion
    },
  },
  methods: {
    ...mapActions([
        'updateInvoiceText',
        'getInvoiceTextById',
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
        this.updateInvoiceText({
            id: this.$route.params.invoiceTextId,
            name: this.typeform.name,
          })
          .then((res) => {
            this.$router.push({name: "InvoiceTexts"});
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

              <div class="form-group mt-5 mb-0">
                <div>
                  <button type="submit" class="btn btn-primary" :disabled="tryingToSubmit">
                    <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Guardar
                  </button>
                  <router-link :to="{name: 'InvoiceTexts'}" class="btn btn-secondary m-l-5 ml-1">Cancelar</router-link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
