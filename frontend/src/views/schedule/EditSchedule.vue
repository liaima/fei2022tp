<template>
  <div>  
    <h1>Editar Horario #{{ this.$route.params.id }}</h1>
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

      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        @submit.prevent="submit"
      >
        <v-autocomplete
          v-model="reg.id_materia"
          :items="courses"
          item-text="nombre"
          item-value="id"
          label="Materia"
          clearable
        >
          <template v-slot:selection="data">{{ data.item.id }} {{data.item.nombre}}</template>
          <template v-slot:item="data">
           <v-list-item-content>
             <v-list-item-title>{{data.item.id}} {{data.item.nombre}}</v-list-item-title>
            </v-list-item-content>
          </template>
        </v-autocomplete>
         <v-autocomplete
          v-model="reg.id_reserva"
          :items="reservations"
          item-text="id"
          item-value="id"
          label="Reserva"
          clearable
        >
          <template v-slot:selection="data">{{ data.item.id }} {{data.item.fh_desde}} {{data.item.fh_hasta}}</template>
          <template v-slot:item="data">
           <v-list-item-content>
             <v-list-item-title>{{data.item.id}} {{data.item.descripcion}} {{data.item.fh_hasta}}</v-list-item-title>
            </v-list-item-content>
          </template>
        </v-autocomplete>
      
      <v-menu
        v-model="dateFromMenu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="reg.fh_desde"
            label="Fecha Desde"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="reg.fh_desde"
          @input="dateFromMenu = false"
        ></v-date-picker>
      </v-menu>
      <v-menu
        v-model="dateToMenu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="reg.fh_hasta"
            label="Fecha Hasta"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          v-model="reg.fh_hasta"
          @input="dateToMenu = false"
        ></v-date-picker>
      </v-menu>

          <v-btn
            class="mr-4"
            color="primary"
            type="submit"
          >
            <v-icon left>
              mdi-content-save
            </v-icon>
            Guardar
          </v-btn>
          <v-btn
            class="mr-4"
            color="secondary"
            @click="goBack"
          >
            <v-icon left>
              mdi-arrow-left
            </v-icon>
            Volver
          </v-btn>
      </v-form>
    </div>
  </div>
</template>

<script>
export default {
  name: "EditSchedule",
  data: () => ({
    reg: {
      id: '',
      id_materia: '',
      id_reserva: '',
      fh_desde: '',
      fh_hasta: '',
    },
    courses: [],
    reservations: [],
    valid: true,
    loading: false,
    requiredRules: [
        v => !!v || 'Este campo es Obligatorio',
      ],
    dateFromMenu: false,
    dateToMenu: false,
  }),
   methods: {
    validate () {
      return this.$refs.form.validate()
    },
    submit () {
      if(this.validate()){
        this.save()
      }
    },
    reset () {
        this.$refs.form.reset()
    },
    goBack() {
      window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
    },

    async loadData(){
      this.loading = true
      await this.axios.get(`/apiv1/horariomateria/${this.$route.params.id}`)
        .then(response =>{
          this.reg = response.data

        })    
        .catch(error=>{
          console.error(error)
        })
        .then( () => {
          this.loading = false;
        })

    },
    async save(){
      this.loading = true;
      await this.axios.put(`/apiv1/horariomateria/${this.$route.params.id}`, this.reg)
        .then(response => {
          console.log(response)
          this.$router.push({name:"reservationCrud"})
         })
        .catch( (error) => {
          console.error(error);
        })
        .then( () => {
          this.loading = false;
        })
    },

    async searchCourses(){
      this.loading = true
      await this.axios.get('/apiv1/materia')
        .then( (response) => {
          this.courses = response.data
        })
        .catch( (error) => {
          console.error(error);
        })
        .then( () => {
          this.loading = false;
        })
    },
    async searchReservations(){
      this.loading = true
      await this.axios.get('/apiv1/reservaaula')
        .then( (response) => {
          this.reservations = response.data
        })
        .catch( (error) => {
          console.error(error);
        })
        .then( () => {
          this.loading = false;
        })
    },

  },
  mounted() {
    this.loadData()
    this.searchCourses()
    this.searchReservations()
  }
}
</script>

