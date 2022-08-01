<template>
   <v-card
     elevation="12"
    height="300"
    width="100%"
   >
     <v-navigation-drawer
       absolute
       permanent
       height="auto"
       width="100%"
     >
       <v-list
       >
         <v-list-item
           v-for="item in items"
           :key="item.title"
           :to="item.to"
           link
         >
           <v-list-item-icon>
             <v-icon>{{ item.icon }}</v-icon>
           </v-list-item-icon>
           <v-list-item-content>
             <v-list-item-title>{{ item.title }}</v-list-item-title>
           </v-list-item-content>
         </v-list-item>
       </v-list>
     </v-navigation-drawer>
   </v-card>
</template>

<script>
  export default {
    name: 'NavButtons',
    data () {
      return {
        items: [
          { title: 'Carreras', icon: 'mdi-school', to:'/tools/career'},
          { title: 'Profesores', icon: 'mdi-account-multiple', to:'/tools/teacher' },
          { title: 'Materias', icon: 'mdi-human-male-board', to:'/tools/course' },
          { title: 'Aulas', icon: 'mdi-chair-school', to:'/tools/classroom' },
        ],
      }
    },
  }
</script>
