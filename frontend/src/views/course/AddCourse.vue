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
        <v-text-field
          v-model="reg.nombre"
          :rules="requiredRules"
          label="Nombre"
          required
          ></v-text-field>
        <v-text-field
          v-model="reg.cant_alumnos"
          label="Cantidad Alumnos"
          ></v-text-field>
        <v-autocomplete
          v-model="reg.id_carrera"
          :items="careers"
          item-text="nombre"
          item-value="id"
          label="Carrera"
          clearable
        ></v-autocomplete>
        <v-autocomplete
          v-model="reg.id_profesor"
          :items="teachers"
          item-text="nombre"
          item-value="id"
          label="Porfesor"
          clearable
        >
          <template v-slot:selection="data">{{ data.item.nombre }} {{data.item.apellido}}</template>
          <template v-slot:item="data">
           <v-list-item-content>
             <v-list-item-title>{{data.item.nombre}} {{data.item.apellido}}</v-list-item-title>
            </v-list-item-content>
          </template>
        </v-autocomplete>
 
          <v-btn
            class="mr-4"
            color="primary"
            type="submit"
            :loading="loading"
            :disabled="loading"
            @click="loader = 'loading'"
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
  name: "AddCourse",
  data: () => ({
    reg: {
      id: '',
      name: '',
      cant_alumnos: '',
      id_carrera: '',
      id_profesor: '',
    },
    careers: [],
    teachers: [],
    valid: true,
    loading: false,
    requiredRules: [
        v => !!v || 'Este campo es Obligatorio',
      ],
    loader: null,
  }),
  watch: {
        loader () {
          const l = this.loader
          this[l] = !this[l]
        },
  },
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

    async searchCareers(){
      await this.axios.get('/apiv1/carrera')
        .then( (response) => {
          this.careers = response.data
        })
        .catch( (error) => {
          console.error(error);
        })

    },

    async searchTeachers(){
      await this.axios.get('/apiv1/profesor')
        .then( (response) => {
          this.teachers = response.data
        })
        .catch( (error) => {
          console.error(error);
        })

    },

    async save(){
      this.loading = true;
      console.log(this.reg)
      var that = this;
      await this.axios.post('/apiv1/materia', that.reg)
        .then(() => {
          this.$router.push({name:"courseCrud"})
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
    this.searchCareers()
    this.searchTeachers()
  }
}
</script>

