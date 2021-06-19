<script>
	import Layout from "../../layouts/horizontal";
	import appConfig from "@/app.config";
  import PageHeader from "../../layouts/page-header";

  import { mapActions, mapGetters } from 'vuex';

	export default {
		page: {
        title: "Listado de Series de Facturas",
        meta: [{ name: "description", content: appConfig.description }]
    },
    components: {
      Layout,
      PageHeader
    },
    data() {
      return {
        title: "Listado de Series de Facturas",
        items: [
          {
            text: "Home",
            href: "/"
          },
          {
            text: "Series de Facturas",
            active: true
          }
        ],
        totalRows: 1,
        currentPage: 1,
        perPage: 10,
        pageOptions: [10, 25, 50, 100],
        filter: null,
        filterOn: [],
        sortBy: "empresa",
        sortDesc: false,
        fields: [
          { label: "Empresa", key: "empresa", sortable: true },
          { label: "Serie", key: "serie", sortable: true },
          { label: "Acciones", key: "actions", sortable: false }
        ],
        deletingId: 0,
      }
    },
    computed: {
      ...mapGetters([
        'series'
      ]),
      /**
       * Total no. of records
       */
      rows() {
        return this.series.length;
      }
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.series.length;
      this.getSeries();
    },
    methods: {
      ...mapActions([
        'getSeries',
        'deleteSerie',
      ]),
      /**
       * Search the table data with search input
       */
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length;
        this.currentPage = 1;
      },
      setId(id) {
        this.deletingId = id;
      },
      realDelete() {
        this.deleteSerie(this.deletingId);
        this.$bvModal.hide('delete-modal');
      }
    }
	};
</script>
<template>
  <Layout>
    <PageHeader :title="title" :items="items">
      <div class="float-right">
        <router-link :to="{name: 'SeriesInvoiceCreate'}"
          class="btn btn-success btn-block d-inline-block"
        >
          <i class="fas fa-plus mr-1"></i> Agregar Serie
        </router-link>
      </div>
    </PageHeader>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-md-2">
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_length" class="dataTables_length">
                  <label class="d-inline-flex align-items-center">
                    Mostrar
                    <b-form-select v-model="perPage" size="sm" :options="pageOptions"></b-form-select>resgistros
                  </label>
                </div>
              </div>
              <!-- Search -->
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_filter" class="dataTables_filter text-md-right">
                  <label class="d-inline-flex align-items-center">
                    Buscar:
                    <b-form-input
                      v-model="filter"
                      type="search"
                      placeholder="Buscar..."
                      class="form-control form-control-sm ml-2"
                    ></b-form-input>
                  </label>
                </div>
              </div>
              <!-- End search -->
            </div>
            <!-- Table -->
            <div class="table-responsive mb-0">
              <b-table
                :items="series"
                :fields="fields"
                responsive="sm"
                :per-page="perPage"
                :current-page="currentPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :filter="filter"
                :filter-included-fields="filterOn"
                @filtered="onFiltered"
              >
                <template #cell(empresa)="row">
                  <span>{{row.item.company.Descripcion}}</span>
                </template>
                <template #cell(serie)="row">
                  <span v-if="row.item.Letra=='' || row.item.Letra==null">{{row.item.Numero +'/'+ row.item.Anio}}</span>
                  <span v-else>{{row.item.Letra +'-'+ row.item.Numero +'/'+ row.item.Anio}}</span>
                </template>
                <template #cell(actions)="row">
                  <router-link :to="{ name: 'SeriesInvoiceEdit', params: { serieId: row.item.id }}" class="btn btn-sm btn-info">
                    <i class="far fa-edit"></i>
                  </router-link>
                  <b-button size="sm" variant="danger" @click="setId(row.item.id)" v-b-modal.delete-modal>
                    <i class="fas fa-trash"></i>
                  </b-button>
                </template>
              </b-table>
            </div>
            <div class="row">
              <div class="col">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                  <ul class="pagination pagination-rounded mb-0">
                    <!-- pagination -->
                    <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage"></b-pagination>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <b-modal
      id="delete-modal"
      centered
      title="Eliminar Usuario"
      title-class="font-18"
      hide-footer
    >
      <p>¿Está seguro de eliminar a este usuario?</p>
      <footer id="delete-modal___BV_modal_footer_" class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="$bvModal.hide('delete-modal')">Cancelar</button>
        <button type="button" class="btn btn-primary" @click="realDelete()">OK</button>
      </footer>
    </b-modal>
  </Layout>
</template>

<style>
  .table thead tr {
    background-color: #c7e6fd;
  }
</style>
