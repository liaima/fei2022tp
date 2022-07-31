<template>
  <div>
    <h1>Error 404 - Pagina No Econtrada</h1>
    <p>{{ route }}</p>
  </div>
</template>

<script>
export default {
  name: 'NotFound',
  computed: {
    route(){
      console.log(this.$route.path)
      if(this.$route.params.route){
        return this.$route.params.route
      }
      return this.$route.path 
    }
  }
}
</script>
