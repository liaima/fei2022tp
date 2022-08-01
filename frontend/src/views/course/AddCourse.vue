<template>
  <div>  
    <h1>Crear Carrera</h1>
    <div>
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        @submit.prevent="submit"
      >
        <v-text-field
          v-model="reg.nombre"
          :rules="nameRules"
          label="Nombre"
          required
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
  name: "AddCourse",
  data: () => ({
    reg: {
      nombre: "",
    },
    valid: true,
    loading: false,
    nameRules: [
        v => !!v || 'El Nombre es Obligatorio',
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

    async save(){
      this.loading = true;
      console.log(this.reg)
      var that = this;
      await this.axios.post('/apiv1/carrera', that.reg)
        .then(response => {
          console.log(response)
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
  }
}
</script>

