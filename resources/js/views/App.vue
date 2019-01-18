<template>
    <div id="app">
      <div v-if="!$route.meta.requiresAdmin">
        <navLight v-if="$route.name == 'Home'"/>
        <navDark v-else/>
      </div>
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>
    </div>
</template>

<script>
import navDark from '../components/nav/navDark.vue'
import navLight from '../components/nav/navLight.vue'

export default {
  components: {navDark, navLight},

  el: '#app',

  mounted(){
    if (this.$store.state.user == null){
      axios.get('/api/user')
      .then( response => {
        this.$store.commit('setUser', response.data.user);
      }).catch( error => {
      })
    }
  }
}
</script>

<style lang="css">
</style>
