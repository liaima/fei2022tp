<template>
  <div>  
    <h1>Administrar Aulas</h1>
    <div>
     <router-link :to='{name:"addClassroom"}'>
       <v-btn
       tile
       color="success"
       >
         <v-icon left>
           mdi-plus
         </v-icon>
         Nuevo
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
                Descripción
              </th>
              <th class="text-left">
                Ubicación
              </th>
              <th class="text-left">
                Cantidad de Proyecotres
              </th>
              <th class="text-left">
                Aforo
              </th>
              <th class="text-left">
                Es Climatizada
              </th>
              <th class="text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="classroom in classrooms"
              :key="classroom.id"
            >
              <td>{{ classroom.id }}</td>
              <td>{{ classroom.descripcion }}</td>
              <td>{{ classroom.ubicacion }}</td>
              <td>{{ classroom.cant_proyector }}</td>
              <td>{{ classroom.aforo }}</td>
              <td>{{ classroom.es_climatizada }}</td>
              <td>
                <router-link :to='{name:"editClassroom", params:{id:classroom.id}}'>
                  <v-btn icon color="primary"><v-icon>mdi-clipboard-edit-outline</v-icon></v-btn>
                </router-link>
                <v-btn icon color="error" @click="remove(classroom.id)"><v-icon>mdi-delete</v-icon></v-btn>
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
  name: "ClassroomCrud",
  data: () => ({
    reg: {
      id: null,
      name: null,
      cant_alumnos: null,
      id_carrera: null,
      id_profesor: null,
    },
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
    classrooms: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/aula?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          that.classrooms = response.data
          if (response.data.length > 0) {
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
      if (confirm('¿Desea Elminar la Aula?')){
        this.axios.delete(`/apiv1/aula/${id}`)
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

