<template lang="html">
  <div class="">
    <navDark/>
    <div class="row bg-dark pt-5 pb-5 text-white">
      <div class="container">
        <h1 class="mb-5">Règlement</h1>
        <div class="container mt-4" v-for="rule in rules">
          <h2>{{ rule.name }}</h2>
          <span v-html="rule.description"></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import navDark from '../components/nav/navDark.vue'

export default {
  components: {navDark},

  data(){
    return{
      rules: [],
    }
  },

  mounted() {
    var _this = this;
    axios.get('/api/rules')
    .then(function(response){
      _this.rules = response.data;
    });
  }
}
</script>

<style lang="css">
</style>
