<template>
    <div id="app">
      <div v-if="!$route.meta.requiresAdmin">
        <navLight v-if="$route.name == 'Home'"/>
        <navDark v-else/>
      </div>
      <div class="container-fluid">
        <transition name="fade" mode="out-in">
          <router-view/>
        </transition>
      </div>
    </div>
</template>

<script>
import navDark from '../components/nav/navDark.vue'
import navLight from '../components/nav/navLight.vue'

export default {
  components: {navDark, navLight},

  el: '#app',

  mounted(){
    this.init();
  },

  methods:{
    async init(){
      if(!this.$store.getters.check) this.getUser();
      if(this.$store.getters.check && !this.$store.getters.admin) this.getNotifications();
    },
    async getUser(){
      await axios.get('/api/user')
      .then( response => {
        this.$store.commit('setUser', response.data.user);
      }).catch( error => {
      })
    },
    getNotifications(){
      axios.get('/api/student.notifications')
      .then((response) => {
        this.$store.commit('setNotifications', response.data);
      });
    }
  }
}
</script>

<style lang="css">
</style>
