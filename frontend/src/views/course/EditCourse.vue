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
            Guardar
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
      nombre: "",
    },
    loading: false,
  }),
  methods: {
    async loadData(){
      await this.axios.get(`/apiv1/carrera/${this.$route.params.id}`)
        .then(response =>{
          this.reg = response.data
        })    
        .catch(error=>{
          console.error(error)
        })
    },
    async save(){
      this.loading = true;
      await this.axios.put(`/apiv1/carrera/${this.$route.params.id}`, this.reg)
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
    }
  },
  mounted() {
    this.loadData()
  }
}
</script>

