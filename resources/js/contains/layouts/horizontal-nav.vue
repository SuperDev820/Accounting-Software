<script>
import { mapActions } from 'vuex';

/**
 * Horizontal navbar component
 */
export default {
  mounted() {
    var links = document.getElementsByClassName("side-nav-link");
    var matchingMenuItem = null;
    for (var i = 0; i < links.length; i++) {
      if (window.location.pathname === links[i].pathname) {
        matchingMenuItem = links[i];
        break;
      }
    }

    if (matchingMenuItem) {
      matchingMenuItem.classList.add("active");
      var parent = matchingMenuItem.parentElement;

      /**
       * TODO: This is hard coded way of expading/activating parent menu dropdown and working till level 3.
       * We should come up with non hard coded approach
       */
      if (parent) {
        parent.classList.add("active");
        const parent2 = parent.parentElement;
        if (parent2) {
          parent2.classList.add("active");
        }
        const parent3 = parent2.parentElement;
        if (parent3) {
          parent3.classList.add("active");
          var childAnchor = parent3.querySelector(".has-dropdown");
          if (childAnchor) childAnchor.classList.add("active");
        }

        const parent4 = parent3.parentElement;
        if (parent4) parent4.classList.add("active");
        const parent5 = parent4.parentElement;
        if (parent5) parent5.classList.add("active");
      }
    }
  },
  methods: {
    ...mapActions([
      'changeLayoutType',
    ]),

    /**
     * menu clicked show the subelement
     */
    onMenuClick(event) {
      event.preventDefault();
      const nextEl = event.target.nextSibling;
      if (nextEl && !nextEl.nextSibling.classList.contains("show")) {
        const parentEl = event.target.parentNode;
        if (parentEl) {
          parentEl.classList.remove("show");
        }
        nextEl.nextSibling.classList.add("show");
      } else if (nextEl) {
        nextEl.nextSibling.classList.remove("show");
      }
      return false;
    },
    topbarLight() {
      document.body.setAttribute("data-topbar", "light");
      document.body.removeAttribute("data-layout-size", "boxed");
    },
    boxedWidth() {
      document.body.setAttribute("data-layout-size", "boxed");
      document.body.removeAttribute("data-topbar", "light");
      document.body.setAttribute("data-topbar", "dark");
    },
    changeLayout(layout) {
      this.changeLayoutType({ layoutType: layout });
    }
  }
};
</script>
<template>
  <div class="topnav">
    <div class="container-fluid">
      <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
        <div class="collapse navbar-collapse" id="topnav-menu-content">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle arrow-none"
                href="javascript: void(0);"
                id="topnav-layout"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                @click="onMenuClick"
              >
                <i class="mdi mdi-settings-outline mr-2"></i> Configuración
              </a>
              <div class="dropdown-menu" aria-labelledby="topnav-layout">
                <router-link tag="a"
                  :to="{name: 'Companies'}"
                  class="dropdown-item side-nav-link"
                >Empresas</router-link>
                <router-link tag="a"
                  :to="{name: 'SeriesInvoices'}"
                  class="dropdown-item side-nav-link"
                >Series Facturas</router-link>
                <router-link tag="a"
                  :to="{name: 'SaleConditions'}"
                  class="dropdown-item side-nav-link"
                >Condiciones Venta</router-link>
                <router-link tag="a"
                  :to="{name: 'PaymentMethods'}"
                  class="dropdown-item side-nav-link"
                >Formas Pago</router-link>
                <router-link tag="a"
                  :to="{name: 'Banks'}"
                  class="dropdown-item side-nav-link"
                >Mto. Bancos</router-link>
                <router-link tag="a"
                  :to="{name: 'IVA'}"
                  class="dropdown-item side-nav-link"
                >Mto. IVA</router-link>
                <router-link tag="a"
                  :to="{name: 'InvoiceTexts'}"
                  class="dropdown-item side-nav-link"
                >Mto. Texto Factura</router-link>
              </div>
            </li>

            <li class="nav-item">
              <router-link tag="a" class="nav-link side-nav-link" :to="{name: 'Contacts'}">
                <i class="far fa-address-book mr-2"></i>Contactos
              </router-link>
            </li>

            <li class="nav-item">
              <router-link tag="a" class="nav-link side-nav-link" :to="{name: 'Companies'}">
                <i class="fab fa-jedi-order mr-2"></i>Pedidos
              </router-link>
            </li>

            <li class="nav-item">
              <router-link tag="a" class="nav-link side-nav-link" :to="{name: 'Companies'}">
                <i class="far fa-building mr-2"></i>Comisiones
              </router-link>
            </li>

            <li class="nav-item">
              <router-link tag="a" class="nav-link side-nav-link" :to="{name: 'Companies'}">
                <i class="far fa-folder-open mr-2"></i>Expedientes
              </router-link>
            </li>

            <li class="nav-item">
              <router-link tag="a" class="nav-link side-nav-link" :to="{name: 'Companies'}">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Facturas
              </router-link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</template>
<style>
  #topnav-menu-content {
    justify-content: flex-end;
  }
</style>