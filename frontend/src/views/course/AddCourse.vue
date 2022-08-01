<template>
  <div>  
    <h1>Administrar Carrera</h1>
    <div>
      <v-form
        ref="form"
        @submit.prevent="save"
      >
        <v-text-field
          v-model="reg.nombre"
          label="Nombre"
          required
          ></v-text-field>
          <v-btn
            class="mr-4"
            type="submit"
          >
            Agregar
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
    currentPage: 0,
    pageCount: 0,
    totalCount: 0,
    loading: false,
  }),
  methods: {
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

