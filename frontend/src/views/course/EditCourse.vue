<template>
  <div>  
    <h1>Editar Materia #{{ this.$route.params.id }} - {{ reg.nombre }}</h1>
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
  name: "EditCourse",
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
      await this.axios.get(`/apiv1/materia/${this.$route.params.id}`)
        .then(response =>{
          this.reg = response.data
        })    
        .catch(error=>{
          console.error(error)
        })
    },
    async save(){
      this.loading = true;
      await this.axios.put(`/apiv1/materia/${this.$route.params.id}`, this.reg)
        .then(response => {
          console.log(response)
          this.$router.push({name:"courseCrud"})
         })
        .catch( (error) => {
          console.error(error);
        })
        .then( () => {
          this.loading = false;
        })
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

  },
  mounted() {
    this.loadData()
    this.searchTeachers()
    this.searchCareers()
  }
}
</script>

