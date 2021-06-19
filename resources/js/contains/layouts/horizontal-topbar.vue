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
          <router-link to="/" class="logo logo-dark">
            <span class="logo-sm">
              <img src="/images/logo-sm.jpg" alt height="120" />
            </span>
            <span class="logo-lg">
              <img src="/images/logo-dark.jpg" alt height="120" width="285" />
            </span>
          </router-link>

          <router-link to="/" class="logo logo-light">
            <span class="logo-sm">
              <img src="/images/logo-sm.jpg" alt height="120" />
            </span>
            <span class="logo-lg">
              <img src="/images/logo-light.jpg" alt height="120" width="285" />
            </span>
          </router-link>
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

        <div class="d-flex align-items-center" style="font-size: 22px;line-height: 0;">
          <router-link class="d-inline-block text-white" to="/logout">
            <i class="fas fa-sign-out-alt align-middle mr-1"></i>
          </router-link>
        </div>
      </div>
    </div>
  </header>
</template>