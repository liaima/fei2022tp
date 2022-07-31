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
          { title: 'Carrera', icon: 'mdi-view-dashboard', to:'/tools/course'},
          { title: 'About', icon: 'mdi-forum' },
        ],
      }
    },
  }
</script>
