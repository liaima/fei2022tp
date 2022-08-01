<template>
  <div>  
    <h1>Crear Aula</h1>
    <div>
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        @submit.prevent="submit"
      >
        <v-text-field
          v-model="reg.descripcion"
          :rules="requiredRules"
          label="Descripción"
          required
          ></v-text-field>
        <v-text-field
          v-model="reg.ubicacion"
          :rules="requiredRules"
          label="Ubicación"
          required
          ></v-text-field>
        <v-text-field
          v-model="reg.cant_proyector"
          label="Cantidad Proyectores"
          ></v-text-field>
        <v-text-field
          v-model="reg.aforo"
          label="Aforo"
          ></v-text-field>

        <v-autocomplete
          v-model="reg.es_climatizada"
          auto-select-first
          :items="climatizada"
          item-text="text"
          item-value="value"
          label="Es Climatizada"
          clearable
        ></v-autocomplete>

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
  name: "AddClassroom",
  data: () => ({
    reg: {
      id: '',
      descripcion: '',
      ubicacion: '',
      cant_proyector: '',
      aforo: '',
      es_climatizada: '',
    },
    climatizada: [
      {value: false, text: 'No'},
      {value: true, text: 'Si'},
    ],
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

    async save(){
      this.loading = true;
      console.log(this.reg)
      var that = this;
      await this.axios.post('/apiv1/aula', that.reg)
        .then(() => {
          this.$router.push({name:"classroomCrud"})
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

