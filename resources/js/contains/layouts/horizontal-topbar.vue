<script>
/**
 * Horizontal-topbar component
 */
export default {
  methods: {
    initFullScreen() {
      document.body.classList.toggle("fullscreen-enable");
      if (
        !document.fullscreenElement &&
        /* alternative standard method */ !document.mozFullScreenElement &&
        !document.webkitFullscreenElement
      ) {
        // current working methods
        if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(
            Element.ALLOW_KEYBOARD_INPUT
          );
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    },
    toggleMenu() {
      let element = document.getElementById("topnav-menu-content");
      element.classList.toggle("show");
    },
    toggleRightSidebar() {
      this.$parent.toggleRightSidebar();
    }
  }
};
</script>

<template>
  <header id="page-topbar">
    <div class="navbar-header">
      <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
          <a href="/" class="logo logo-dark">
            <span class="logo-sm">
              <img src="/images/logo-sm.png" alt height="22" />
            </span>
            <span class="logo-lg">
              <img src="/images/logo-dark.png" alt height="45" />
            </span>
          </a>

          <a href="/" class="logo logo-light">
            <span class="logo-sm">
              <img src="/images/logo-sm.png" alt height="22" />
            </span>
            <span class="logo-lg">
              <img src="/images/logo-light.png" alt height="45" />
            </span>
          </a>
        </div>

        <button
          type="button"
          class="btn btn-sm mr-2 font-size-24 d-lg-none header-item"
          @click="toggleMenu"
        >
          <i class="mdi mdi-menu"></i>
        </button>
      </div>

      <div class="d-flex">
        <div class="dropdown d-none d-lg-inline-block">
          <button type="button" class="btn header-item noti-icon" @click="initFullScreen">
            <i class="mdi mdi-fullscreen"></i>
          </button>
        </div>

        <b-dropdown class="d-inline-block" right toggle-class="header-item" variant="white">
          <template v-slot:button-content>
            <img
              class="rounded-circle header-profile-user"
              src="/images/user.jpg"
              alt="Header Avatar"
            />
          </template>
          <a class="dropdown-item text-danger" href="/logout">
            <i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Cerrar Sesión
          </a>
        </b-dropdown>
      </div>
    </div>
  </header>
</template>