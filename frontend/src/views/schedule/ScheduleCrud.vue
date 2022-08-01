<template>
  <div>  
    <h1>Administrar Horarios</h1>
    <div>
     <router-link :to='{name:"addSchedule"}'>
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
      <v-dialog
      v-model="loading"
      persistent
      width="400"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          Cargando...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">
                ID
              </th>
              <th class="text-left">
                Materia
              </th>
              <th class="text-left">
                Reserva
              </th>
              <th class="text-left">
                Fecha Desde
              </th>
              <th class="text-left">
                Fecha Hata
              </th>
              <th class="text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="schedule in schedules"
              :key="schedule.id"
            >
              <td>{{ schedule.id }}</td>
              <td>{{ schedule.id_materia }}</td>
              <td>{{ schedule.id_reserva }}</td>
              <td>{{ schedule.fh_desde }}</td>
              <td>{{ schedule.fh_hasta }}</td>
              <td>
                <router-link :to='{name:"editSchedule", params:{id:schedule.id}}'>
                  <v-btn icon color="primary"><v-icon>mdi-clipboard-edit-outline</v-icon></v-btn>
                </router-link>
                <v-btn icon color="error" @click="remove(schedule.id)"><v-icon>mdi-delete</v-icon></v-btn>
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
  name: "ScheduleCrud",
  data: () => ({
    reg: {
      id: '',
      id_materia: '',
      id_reserva: '',
      fh_desde: '',
      fh_hasta: '',
    },
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
    schedules: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/horariomateria?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          that.schedules = response.data
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
      if (confirm('¿Desea Elminar el horario?')){
        this.axios.delete(`/apiv1/horariomateria/${id}`)
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

