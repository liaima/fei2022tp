<template>
  <div>  
    <h1>Editar Profesor/a #{{ this.$route.params.id }} - {{ reg.nombre }} {{ reg.apellido }}</h1>
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
          v-model="reg.apellido"
          :rules="requiredRules"
          label="Apellido"
          required
          ></v-text-field>
        <v-text-field
          v-model="reg.mostrar"
          :rules="requiredRules"
          label="Mostrar"
          required
          ></v-text-field>

          <v-btn
            class="mr-4"
            color="primary"
            type="submit"
            :loading="loading"
            :disabled="loading"
            @click="loader = 'loading'"
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
  name: "EditTeacher",
  data: () => ({
    reg: {
      nombre: "",
      apellido: "",
      mostrar: "",

    },
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

    async loadData(){
      await this.axios.get(`/apiv1/profesor/${this.$route.params.id}`)
        .then(response =>{
          this.reg = response.data
        })    
        .catch(error=>{
          console.error(error)
        })
    },
    async save(){
      this.loading = true;
      await this.axios.put(`/apiv1/profesor/${this.$route.params.id}`, this.reg)
        .then(response => {
          console.log(response)
          this.$router.push({name:"teacherCrud"})
         })
        .catch( (error) => {
          console.error(error);
        })
        .then( () => {
          this.loading = false;
        })
    }
  },
  mounted() {
    this.loadData()
  }
}
</script>

