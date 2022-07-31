<template>
  <div>  
    <h1>Administrar Carrera</h1>
    <div>
     <router-link :to='{name:"addCourse"}'>
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
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="course in courses"
              :key="course.id"
            >
              <td>{{ course.id }}</td>
              <td>{{ course.nombre }}</td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </div>
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
    courses: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/carrera?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          if (response.data.length > 0) {
            that.courses = response.data
            /*
            that.reg.id = response.data[0].id
            that.reg.name = response.data[0].nombre*/
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

