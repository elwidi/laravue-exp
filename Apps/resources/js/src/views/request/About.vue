<template>
  <v-row>
    <v-col
      cols="12"
      class="mb-6"
    >
    {{info}}
    </v-col>
    <v-col cols="12">
      
    </v-col>
  </v-row>
</template>

<script>
import TypographyHeadlines from './TypographyHeadlines.vue'
import axios from 'axios';

export default {
  components: {
    TypographyHeadlines,
  },
  data(){
    return {
      info: null
    }
  },
  mounted(){
    axios.get('/api/request')
    .then(response => (this.info = response.data))
  }
}
</script>
