<template>
  <div>
    <div>
      <v-dialog
      v-model="loading"
      persistent
      width="400"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          Cargando...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
    </div>
    <div>
      <h1>Horarios de Reservas</h1>
      <v-calendar
        ref="calendar"
        v-model="value"
        :type="type"
        :events="events"
        :event-overlap-mode="mode"
        :event-overlap-threshold="30"
        :event-color="getEventColor"
        @change="getEvents"
      ></v-calendar>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeComponent',
  data: () => ({
    type: 'month',
    types: ['month', 'week', 'day', '4day'],
    mode: 'stack',
    value: '',
    events: [],
    colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
    schedules: [],
    loading: true,
  }),
    methods: {
      getEvents () {
        this.loading = true
        const events = []
        this.axios.get('/apiv1/horariomateria')
          .then( (response) => {
            const data = response.data
            data.forEach ((item) => {
              const dateInit = new Date(item.fh_desde)
              const dateEnd = new Date(item.fh_hasta)

              events.push({
                name: `${item.materia.nombre} - ${item.aulaDescripcion}`,
                start: dateInit,
                end: dateEnd,
                color: this.colors[this.rnd(0, this.colors.length - 1)],
                timed: false,
              })
            })
            console.log(events)
            this.events = events
  
          })
          .catch( (error) => {
            console.error(error);
          })
          .then(() => {
            this.loading = false
          })
      },
      getEventColor (event) {
        return event.color
      },
      rnd (a, b) {
        return Math.floor((b - a + 1) * Math.random()) + a
      },
    },
}
</script>
