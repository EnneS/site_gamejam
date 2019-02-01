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

  async beforeCreate(){
    await axios.get('/api/user')
    .then( response => {
      this.$store.commit('setUser', response.data.user);
    }).catch( error => {
    })
  },

  mounted(){
    this.init();
  },

  methods:{
    async init(){
      this.getNotifications();
    },
    async getUser(){

    },
    getNotifications(){
      if(this.$store.getters.check && !this.$store.getters.admin){
        axios.get('/api/student.notifications')
        .then((response) => {
          this.$store.commit('setNotifications', response.data);
        });
      }
    }
  }
}
</script>

<style lang="css">
</style>
