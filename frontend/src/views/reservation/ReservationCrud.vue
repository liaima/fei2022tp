<template>
  <div>  
    <h1>Administrar Reservas</h1>
    <div>
     <router-link :to='{name:"addReservation"}'>
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
                Aula
              </th>
              <th class="text-left">
                Fecha Desde
              </th>
              <th class="text-left">
                Fecha Hata
              </th>
              <th class="text-left">
                Observaciones
              </th>
              <th class="text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="reservation in reservations"
              :key="reservation.id"
            >
              <td>{{ reservation.id }}</td>
              <td>{{ reservation.aula.descripcion }}</td>
              <td>{{ reservation.fh_desde }}</td>
              <td>{{ reservation.fh_hasta }}</td>
              <td>{{ reservation.observacion }}</td>
              <td>
                <router-link :to='{name:"editReservation", params:{id:reservation.id}}'>
                  <v-btn icon color="primary"><v-icon>mdi-clipboard-edit-outline</v-icon></v-btn>
                </router-link>
                <v-btn icon color="error" @click="remove(reservation.id)"><v-icon>mdi-delete</v-icon></v-btn>
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
  name: "ReservationCrud",
  data: () => ({
    reg: {
      id: '',
      id_aula: '',
      fh_desde: '',
      fh_hasta: '',
      observacion: '',
    },
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
    reservations: [],
  }),
  methods: {
    loadData(page){
      this.loading = true;
      var that = this;
      this.axios.get('/apiv1/reservaaula?per-page=10@page=' + page)
        .then( (response) => {
          console.log(response)
          that.reservations = response.data
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
      if (confirm('¿Desea Elminar la Reserva?')){
        this.axios.delete(`/apiv1/reservaaula/${id}`)
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

