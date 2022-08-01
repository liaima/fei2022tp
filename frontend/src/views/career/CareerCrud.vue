<template>
  <div>  
    <h1>Administrar Carrera</h1>
    <div>
     <router-link :to='{name:"addCareer"}'>
       <v-btn
       tile
       color="success"
       >
         <v-icon left>
           mdi-plus
         </v-icon>
         Nueva
       </v-btn>
     </router-link>
    </div>
    <div>
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">
                ID
              </th>
              <th class="text-left">
                Nombre
              </th>
              <th class="text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="career in careers"
              :key="career.id"
            >
              <td>{{ career.id }}</td>
              <td>{{ career.nombre }}</td>
              <td>
                <router-link :to='{name:"editCareer", params:{id:career.id}}'>
                  <v-btn icon color="primary"><v-icon>mdi-clipboard-edit-outline</v-icon></v-btn>
                </router-link>
                <v-btn icon color="error" @click="remove(career.id)"><v-icon>mdi-delete</v-icon></v-btn>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </div>
  </div>
</template>

<script>
export default {
  name: "CareerCrud",
  data: () => ({
    reg: {
      id: null,
      name: null,
    },
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
    careers: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/carrera?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          if (response.data.length > 0) {
            that.careers = response.data
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
    },
    remove(id){
      if (confirm('¿Desea Elminar la Carrera?')){
        this.axios.delete(`/apiv1/carrera/${id}`)
          .then(() => {
            this.loadData(1)
          })
          .catch(error => {
            console.error(error)
          })
      }
    },
  },
  mounted() {
    this.loadData(1)
  }
}
</script>

