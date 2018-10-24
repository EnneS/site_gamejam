<template lang="html">
  <div class="">
    <navDark/>
    <div class="row bg-dark pt-5 pb-5 text-white">
      <div class="container">
        <h1 class="mb-5">Mon équipe</h1>
        <div v-if="team != ''">
          <h4> {{ team.name }}</h4>
        </div>
        <div v-else>
          <h2>Vous n'avez pas encore d'équipe !</h2>
          <router-link to="/mon-equipe/creer" tag="button" class="btn-gamejam mr-4" exact>créer votre équipe</router-link>
          <router-link to="/equipes" tag="button" class="btn-gamejam" exact>rejoindre une équipe</router-link>
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
    return {
      team : null,
    }
  },

  mounted() {
    this.getTeam();
  },

  methods:{
    getTeam(){
      var _this = this;
      axios.get('/api/student.team')
      .then(function(response){
        _this.team = response.data;
      });
    }
  }
}
</script>

<style lang="css">
</style>
