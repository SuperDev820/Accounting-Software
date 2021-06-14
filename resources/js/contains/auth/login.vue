<script>
import appConfig from "@/app.config";
import {mapActions, mapGetters} from 'vuex'
import {
  required,
  minLength,
} from "vuelidate/lib/validators";
/**
 * Login component
 */
export default {
  page: {
    title: "Login",
    meta: [{ name: "description", content: appConfig.description }]
  },
  components: {},
  data() {
    return {
      typeform: {
        password: "",
        name: "",
      },
      authError: null,
      tryingToSubmit: false,
      isAuthError: false,
      typesubmit: false,
    };
  },
  validations: {
    typeform: {
      password: { required, minLength: minLength(6) },
      name: { required },
    }
  },
  computed: {
    ...mapGetters([
    ]),
  },
  methods: {
    ...mapActions([
      'login'
    ]),
    // Try to log the user in with the username
    // and password they provided.
    typeForm(e) {
      this.typesubmit = true;
      // Reset the authError if it existed.
      this.authError = null;
      this.isAuthError = false;
      this.$v.$touch()
      if (this.$v.typeform.name.$error || this.$v.typeform.password.$error) {
        return ;
      }
      this.tryingToSubmit = true;
      return (
        this.login({
            email: this.typeform.name,
            password: this.typeform.password
          })
          .then((res) => {
            this.typesubmit = false;
            this.tryingToSubmit = false;
            this.isAuthError = false;
            this.$router.push({name: "home"});
          })
          .catch(error => {
            this.typesubmit = false;
            this.tryingToSubmit = false;
            this.authError = error ? error.data : "";
            this.isAuthError = true;
          })
      );
    }
  }
};
</script>

<template>
  <div class="account-pages my-5 pt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
            <div class="bg-primary">
              <div class="text-primary text-center p-4">
                <h5 class="text-white font-size-20 mb-3">Inicia sesión para continuar.</h5>
                <a href="/" class="logo logo-admin">
                  <img src="/images/logo-sm.png" height="24" alt="logo" />
                </a>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="p-3">
                <b-alert
                  v-model="isAuthError"
                  variant="danger"
                  class="mt-3"
                  dismissible
                >{{authError}}</b-alert>

                <form action="#" @submit.prevent="typeForm" class="form-horizontal mt-4">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input
                      v-model="typeform.name"
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="Enter Nombre"
                      :class="{ 'is-invalid': typesubmit && $v.typeform.name.$error }"
                    />
                    <div v-if="typesubmit && $v.typeform.name.$error" class="invalid-feedback">
                      <span v-if="!$v.typeform.name.required">Este Campo es obligatorio.</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Contraseña</label>
                    <input
                      v-model="typeform.password"
                      type="password"
                      name="password"
                      class="form-control"
                      placeholder="Enter Contraseña"
                      :class="{ 'is-invalid': typesubmit && $v.typeform.password.$error }"
                    />
                    <div v-if="typesubmit && $v.typeform.password.$error" class="invalid-feedback">
                      <span v-if="!$v.typeform.password.required">Este Campo es obligatorio.</span>
                      <span
                        v-if="!$v.typeform.password.minLength"
                      >La contraseña debe tener al menos 6 cracteres.</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <b-form-checkbox
                        id="checkbox-1"
                        name="checkbox-1"
                        value="accepted"
                        unchecked-value="not_accepted"
                      >Recuérdame</b-form-checkbox>
                    </div>
                    <div class="col-sm-6 text-right">
                      <b-button type="submit" variant="primary" class="w-md" :disabled="tryingToSubmit">
                        <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Aceptar
                      </b-button>
                    </div>
                  </div>

                  <!-- <div class="form-group mt-2 mb-0 row">
                    <div class="col-12 mt-4">
                      <router-link tag="a" to="/forgot-password">
                        <i class="mdi mdi-lock"></i> Forgot your password?
                      </router-link>
                    </div>
                  </div> -->
                </form>
              </div>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
          <div class="mt-5 text-center">
            <p>
              ¿No tienes una cuenta?
              <router-link tag="a" to="/register" class="font-weight-medium text-primary">Regístrate ahora</router-link>
            </p>
            <p class="mb-0">
              ©
              {{new Date().getFullYear()}} 
              <i
                class="mdi mdi-heart text-danger"
              ></i> by Organizer
            </p>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
  </div>
</template>

<style lang="scss" module></style>
