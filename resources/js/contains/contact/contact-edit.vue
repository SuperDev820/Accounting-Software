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
      name: { required },
    }
  },
  mounted() {
    this.getContactById(this.$route.params.contactId);
  },
  computed: {
    ...mapGetters([
      'company',
    ]),
  },
  watch: {
    contact: function () {
      this.typeform.code = this.contact.IdEmpresa
      this.typeform.name = this.contact.Descripcion
      this.typeform.image = this.contact.Ruta
      this.typeform.title = this.contact.Titulo
      this.typeform.direction = this.contact.Direccion
      this.typeform.return = this.contact.Remite
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
            IdEmpresa: this.typeform.code,
            name: this.typeform.name,
            image: this.typeform.image,
            title: this.typeform.title,
            direction: this.typeform.direction,
            return: this.typeform.return,
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
