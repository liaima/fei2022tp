<template>
  <div>  
    <h1>Administrar Profesores</h1>
    <div class="pa-6">
     <router-link :to='{name:"addTeacher"}'>
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
    <v-progress-linear
      indeterminate
      color="teal"
      :hidden="!loading"
    ></v-progress-linear>

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
                Apellido
              </th>
              <th class="text-left">
                Mostrar
              </th>
              <th class="text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="teacher in teachers"
              :key="teacher.id"
            >
              <td>{{ teacher.id }}</td>
              <td>{{ teacher.nombre }}</td>
              <td>{{ teacher.apellido }}</td>
              <td>{{ teacher.mostrar }}</td>
              <td>
                <router-link :to='{name:"editTeacher", params:{id:teacher.id}}'>
                  <v-btn icon color="primary"><v-icon>mdi-clipboard-edit-outline</v-icon></v-btn>
                </router-link>
                <v-btn icon color="error" @click="remove(teacher.id)"><v-icon>mdi-delete</v-icon></v-btn>
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
  name: "TeacherCrud",
  data: () => ({
    reg: {
      id: null,
      name: null,
    },
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
    teachers: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/profesor?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          that.teachers = response.data
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
      if (confirm('¿Desea Elminar el Profesor?')){
        this.axios.delete(`/apiv1/profesor/${id}`)
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

