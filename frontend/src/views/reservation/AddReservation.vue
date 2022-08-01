<template>
  <div>  
    <h1>Crear Materia</h1>
    <div>
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        @submit.prevent="submit"
      >
        <v-autocomplete
          v-model="reg.id_aula"
          :items="classrooms"
          item-text="descripcion"
          item-value="id"
          label="Aula"
          clearable
        >
          <template v-slot:selection="data">{{ data.item.id }} {{data.item.descripcion}}</template>
          <template v-slot:item="data">
           <v-list-item-content>
             <v-list-item-title>{{data.item.id}} {{data.item.descripcion}}</v-list-item-title>
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
        <v-text-field
          v-model="reg.observacion"
          label="Observaciones"
          ></v-text-field>

          <v-btn
            class="mr-4"
            color="primary"
            type="submit"
          >
            <v-icon left>
              mdi-plus
            </v-icon>
            Agregar
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
          <v-btn
            class="mr-4"
            color="warning"
            @click="reset"
          >
            <v-icon left>
              mdi-autorenew
            </v-icon>
            Limpiar
          </v-btn>
      </v-form>
    </div>
  </div>
</template>

<script>
export default {
  name: "AddReservation",
  data: () => ({
    reg: {
      id: '',
      id_aula: '',
      fh_desde: '',
      fh_hasta: '',
      observacion: '',
    },
    classrooms: [],
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

    async searchClassrooms(){
      await this.axios.get('/apiv1/aula')
        .then( (response) => {
          this.classrooms = response.data
        })
        .catch( (error) => {
          console.error(error);
        })

    },

    async save(){
      this.loading = true;
      console.log(this.reg)
      var that = this;
      await this.axios.post('/apiv1/reservaaula', that.reg)
        .then(() => {
          this.$router.push({name:"reservationCrud"})
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
    this.searchClassrooms()
  }
}
</script>

