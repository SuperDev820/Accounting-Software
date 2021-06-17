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
          href: "/settings/companies"
        },
        {
          text: "Detalle de Empresa",
          active: true
        }
      ],
      isError: false,
      Error: null,
      typeform: {
        code: "",
        description: "",
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
  mounted() {
    this.getSaleConditionById(this.$route.params.conditionId);
  },
  computed: {
    ...mapGetters([
      'saleCondition',
    ]),
  },
  watch: {
    saleCondition: function () {
      this.typeform.code = this.saleCondition.CondicionVenta
      this.typeform.description = this.saleCondition.Descripcion
    },
  },
  methods: {
    ...mapActions([
        'updateSaleCondition',
        'getSaleConditionById',
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
        this.updateSaleCondition({
            id: this.$route.params.conditionId,
            CondicionVenta: this.typeform.code,
            description: this.typeform.description,
          })
          .then((res) => {
            this.$router.push({name: "SaleConditions"});
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
                <label>Descripcion: </label>
                <input
                  v-model="typeform.description"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-12 mt-5 mb-0">
                <div>
                  <button type="submit" class="btn btn-primary" :disabled="tryingToSubmit">
                    <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Guardar
                  </button>
                  <router-link :to="{name: 'SaleConditions'}" class="btn btn-secondary m-l-5 ml-1">Cancelar</router-link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
