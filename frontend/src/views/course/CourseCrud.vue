<template>
  <div>  
    <h1>Administrar Materias</h1>
    <div>
     <router-link :to='{name:"addCourse"}'>
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
                Nombre
              </th>
              <th class="text-left">
                Cantidad Alumnos
              </th>
              <th class="text-left">
                Carrera
              </th>
              <th class="text-left">
                Profesor
              </th>
              <th class="text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="course in courses"
              :key="course.id"
            >
              <td>{{ course.id }}</td>
              <td>{{ course.nombre }}</td>
              <td>{{ course.cant_alumnos }}</td>
              <td>{{ course.carrera.nombre }}</td>
              <td>{{ course.profesor.nombre }} {{ course.profesor.apellido }}</td>
              <td>
                <router-link :to='{name:"editCourse", params:{id:course.id}}'>
                  <v-btn icon color="primary"><v-icon>mdi-clipboard-edit-outline</v-icon></v-btn>
                </router-link>
                <v-btn icon color="error" @click="remove(course.id)"><v-icon>mdi-delete</v-icon></v-btn>
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
  name: "CourseCrud",
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
    courses: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/materia?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          that.courses = response.data
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
      if (confirm('¿Desea Elminar la Materia?')){
        this.axios.delete(`/apiv1/materia/${id}`)
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

