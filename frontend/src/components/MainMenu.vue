<template>
  <v-container>
    <v-navigation-drawer
      color="#67b4ff"
      app
      permanent
      >
      <v-list-item>
        <v-img
          alt="Aulas Logo"
          class="shrink mr-2"
          contain
          :src="require('../assets/logo_blanco.png')"
          transition="scale-transition"
          width="70"
          />
          <v-list-item-content>
            <v-list-item-title class="text-h6">
              Aulas Curza
            </v-list-item-title>
            <v-list-item-subtitle>
              FEI
            </v-list-item-subtitle>
          </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list danse>
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
  </v-container>
</template>

<script>
  export default {
    name: 'MainMenu',

    data: () => ({
      items: [
        {title: 'Home', icon: 'mdi-view-dashboard', to: '/'},
        {title: 'Acerca de', icon: 'mdi-information-variant', to: '/about'},
        {title: 'Administración', icon: 'mdi-hammer-wrench', to: '/tools'},
      ],
    }),
    mouted(){

    },
    computed: {

    }
  }
</script>
