<script>
import Layout from "../../layouts/horizontal";
import appConfig from "@/app.config";
import PageHeader from "../../layouts/page-header";
import Multiselect from "vue-multiselect";

import { mapActions, mapGetters } from 'vuex';

import {
  required,
} from "vuelidate/lib/validators";

export default {
  page: {
    title: "Detalle de Series de Facturas",
    meta: [{ name: "description", content: appConfig.description }]
  },
  components: { Layout, PageHeader, Multiselect },
  data() {
    return {
      title: "Detalle de Series de Facturas",
      items: [
        {
          text: "Home",
          href: "/"
        },
        {
          text: "Series",
          href: "/settings/series-invoices"
        },
        {
          text: "Detalle de Serie",
          active: true
        }
      ],
      companyOptions: [],
      isError: false,
      Error: null,
      typeform: {
        company: {},
        lyrics: "",
        number: "",
        year: "",
      },
      typesubmit: false,
      tryingToSubmit: false,
    };
  },
  validations: {
    typeform: {
      company: { required },
    }
  },
  mounted() {
    this.getCompanies();
  },
  computed: {
    ...mapGetters([
      'serie',
      'companies',
    ]),
  },
  watch: {
    companies: function () {
      var that = this;
      this.companies.forEach(function(item, index) {
        let temp = {}
        temp.value = item.id
        temp.label = item.Descripcion
        that.companyOptions.push(temp)
      })
      // console.log(this.companyOptions)
      this.getSerieById(this.$route.params.serieId);
    },
    serie: function () {
      let temp = {}
      temp.value = this.serie.company.id
      temp.label = this.serie.company.Descripcion
      this.typeform.company = {...temp}
      this.typeform.lyrics = this.serie.Letra
      this.typeform.number = this.serie.Numero
      this.typeform.year = this.serie.Anio
      // console.log(this.typeform)
    },
  },
  methods: {
    ...mapActions([
        'updateSerie',
        'getSerieById',
        'getCompanies',
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
      if (this.$v.typeform.company.$error) {
        return ;
      }
      this.tryingToSubmit = true;
      return (
        this.updateSerie({
            id: this.$route.params.serieId,
            company: this.typeform.company.value,
            lyrics: this.typeform.lyrics,
            number: this.typeform.number,
            year: this.typeform.year,
          })
          .then((res) => {
            this.$router.push({name: "SeriesInvoices"});
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
                <label>Empresa: </label>
                <multiselect 
                  v-model="typeform.company" 
                  deselect-label=""
                  label="label"
                  :options="companyOptions"
                  :class="{ 'is-invalid': typesubmit && $v.typeform.company.$error }"
                ></multiselect>
                <div v-if="typesubmit && $v.typeform.company.$error" class="invalid-feedback">
                  <span v-if="!$v.typeform.company.required">Este Campo es obligatorio.</span>
                </div>
              </div>

              <div class="form-group col-8">
                <label>Letra: </label>
                <input
                  v-model="typeform.lyrics"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-8">
                <label>Número: </label>
                <input
                  v-model="typeform.number"
                  type="number"
                  class="form-control"
                />
              </div>

              <div class="form-group col-8">
                <label>Año: </label>
                <input
                  v-model="typeform.year"
                  type="text"
                  class="form-control"
                />
              </div>

              <div class="form-group col-12 mt-5 mb-0">
                <div>
                  <button type="submit" class="btn btn-primary" :disabled="tryingToSubmit">
                    <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Guardar
                  </button>
                  <router-link :to="{name: 'SeriesInvoices'}" class="btn btn-secondary m-l-5 ml-1">Cancelar</router-link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
