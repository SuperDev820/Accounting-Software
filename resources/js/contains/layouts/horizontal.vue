<script>
import HorizontalTopbar from "./horizontal-topbar";
import HorizontalNav from "./horizontal-nav";
import Footer from "./footer";

/**
 * Horizontal-layout component
 */
export default {
  components: { HorizontalTopbar, HorizontalNav, Footer },
  computed: {
  },
  created: () => {
    document.body.setAttribute("data-layout", "horizontal");
    document.body.setAttribute("data-topbar", "light");
    document.body.setAttribute("data-layout-size", "boxed");
    document.body.removeAttribute("data-sidebar");
    document.body.classList.remove("vertical-collpsed");
    document.body.removeAttribute('data-sidebar-size');
  },
  methods: {
    toggleRightSidebar() {
      document.body.classList.toggle("right-bar-enabled");
    },
    hideRightSidebar() {
      document.body.classList.remove("right-bar-enabled");
    }
  }
};
</script>

<template>
  <div id="layout-wrapper">
    <HorizontalTopbar />
    <HorizontalNav />

    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          <slot />
        </div>
      </div>
      <Footer />
    </div>
  </div>
</template>