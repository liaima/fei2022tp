<template>
  <div>  
    <h1>Administrar Carrera</h1>
    <router-link :to='{name:"addCourse"}'>+</router-link>
    <v-text-field
      v-model="reg.name"
      label="Nombre"
      required
      ></v-text-field>
  </div>
</template>

<script>
import axios from '@/plugins/axios';
export default {
  name: "CourseCrud",
  data: () => ({
    reg: {
      id: null,
      name: null,
    },
    axios: axios,
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/carrera?per-page=1@page=' + page)
        .then( (response) => {
          console.log(response)
          if (response.data.length > 0) {
            that.reg.id = response.data[0].id
            that.reg.name = response.data[0].nombre
            that.currentPage = response.headers["x-pagination-current-page"]
            that.pageCount = response.headers["x-pagination-page-count"]
            that.totalCount = response.headers["x-pagination-total-count"]
          }
        })
        .catch( (error) => {
          console.error(error);
        })
        .then( () => {
          that.loading = false;
        })
    }
  },
  mounted() {
    this.loadData(1)
  }
}
</script>

