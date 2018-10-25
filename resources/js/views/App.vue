<template>
    <div id="app">
      <navLight v-if="$route.name == 'Home'"/>
      <navDark v-else/>
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
    console.log(this.$route.name);
  }
}
</script>

<style lang="css">
</style>
