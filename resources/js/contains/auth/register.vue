<script>
import appConfig from "@/app.config";
import {
  required,
  email,
  minLength,
} from "vuelidate/lib/validators";
/**
 * Register component
 */
export default {
  page: {
    title: "Register",
    meta: [{ name: "description", content: appConfig.description }]
  },
  data() {
    return {
      typeform: {
        username: "",
        password: "",
        email: "",
      },
      regError: null,
      tryingToSubmit: false,
      isRegisterError: false,
      typesubmit: false,
    };
  },
  validations: {
    typeform: {
      password: { required, minLength: minLength(6) },
      email: { required, email },
      username: { required },
    }
  },
  methods: {
    // Try to register the user in with the email, username
    // and password they provided.
    typeForm(e) {
      this.typesubmit = true;
      // Reset the regError if it existed.
      this.regError = null;
      this.isRegisterError = false;
      this.$v.$touch()
      if (this.$v.typeform.username.$error || this.$v.typeform.email.$error || this.$v.typeform.password.$error) {
        return ;
      }
      this.tryingToSubmit = true;
      return (
        this.$store
          .dispatch("register", {
              name: this.typeform.username,
              email: this.typeform.email,
              password: this.typeform.password,
              password_confirmation: this.typeform.password
          })
          .then((res, status) => {
            this.typesubmit = false;
            this.tryingToSubmit = false;
            this.isRegisterError = false;
            this.$router.push({ name: "login" });
          })
          .catch((error) => {
            this.typesubmit = false;
            this.tryingToSubmit = false;
            this.regError = error ? error.data : "";
            this.isRegisterError = true;
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
                <h5 class="text-white font-size-20">Free Register</h5>
                <p class="text-white-50">Register to start.</p>
                <a href="/" class="logo logo-admin">
                  <img src="/images/logo-sm.png" height="24" alt="logo" />
                </a>
              </div>
            </div>

            <div class="card-body p-4">
              <div class="p-3">
                <b-alert
                  v-model="isRegisterError"
                  class="mt-3"
                  variant="danger"
                  dismissible
                >{{regError}}</b-alert>

                <b-form action="#" @submit.prevent="typeForm" class="form-horizontal mt-4">
                  <b-form-group id="username-group" label="Nombre" label-for="username">
                    <b-form-input
                      id="username"
                      v-model="typeform.username"
                      type="text"
                      placeholder="Enter Nombre"
                      :class="{ 'is-invalid': typesubmit && $v.typeform.username.$error }"
                    ></b-form-input>
                    <div v-if="typesubmit && $v.typeform.username.$error" class="invalid-feedback">
                      <span v-if="!$v.typeform.username.required">Este Campo es obligatorio.</span>
                    </div>
                  </b-form-group>

                  <b-form-group id="email-group" label="E-Mail" label-for="email">
                    <b-form-input 
                      id="email" 
                      v-model="typeform.email" 
                      type="email" 
                      placeholder="Enter E-Mail"
                      :class="{ 'is-invalid': typesubmit && $v.typeform.email.$error }"
                    ></b-form-input>
                    <div v-if="typesubmit && $v.typeform.email.$error" class="invalid-feedback">
                      <span v-if="!$v.typeform.email.required">Este Campo es obligatorio.</span>
                      <span v-if="!$v.typeform.email.email">Debe ser un e-mail válido.</span>
                    </div>
                  </b-form-group>

                  <b-form-group id="password-group" label="Contraseña" label-for="password">
                    <b-form-input
                      id="password"
                      v-model="typeform.password"
                      type="password"
                      placeholder="Enter Contraseña"
                      :class="{ 'is-invalid': typesubmit && $v.typeform.password.$error }"
                    ></b-form-input>
                    <div v-if="typesubmit && $v.typeform.password.$error" class="invalid-feedback">
                      <span v-if="!$v.typeform.password.required">Este Campo es obligatorio.</span>
                      <span
                        v-if="!$v.typeform.password.minLength"
                      >La contraseña debe tener al menos 6 cracteres.</span>
                    </div>
                  </b-form-group>

                  <div class="form-group mb-0 text-center">
                    <div class="col-12 text-right">
                      <b-button type="submit" variant="primary" class="w-md" :disabled="tryingToSubmit">
                        <i class="fa fa-spinner fa-spin" v-if="tryingToSubmit"></i> Register
                      </b-button>
                    </div>
                  </div>
                  <div class="form-group mt-2 mb-0 row">
                    <div class="col-12 mt-4">
                      <p class="mb-0">
                        By registering you agree to the Software
                        <a
                          href="#"
                          class="text-primary"
                        >Terms of Use</a>
                      </p>
                    </div>
                  </div>
                </b-form>
              </div>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
          <div class="mt-5 text-center">
            <p>
              Already have an account ?
              <router-link tag="a" to="/login" class="font-weight-medium text-primary">Login</router-link>
            </p>
            <p>
              ©{{new Date().getFullYear()}} 
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
