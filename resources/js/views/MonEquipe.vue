<template lang="html">
  <div class="">
    <div class="row bg-dark pt-5 pb-5 text-white">
      <div class="container">
        <h1 class="mb-3">Mon équipe</h1>
        <div v-if="this.team != null">
          <!-- l'équipe, ses membres -->
          <div class="row mb-4">
            <div class="col">
              <h2> {{ team.name }}</h2>
              <h5>Membres</h5>
              <ul class="list-group text-dark">
                <li class="list-group-item" v-for="student in team.students">{{ student.first_name }} {{ student.last_name}}</li>
              </ul>
            </div>
            <!-- le jeu -->
            <div class="col">
              <h2> {{ team.game.name }}</h2>
              <!-- jaquette du jeu -->
              <div v-if="!team.game.jaquette_uploaded" class="upload-zip">
                Ajouter une jaquette
              </div>
              <div v-else>
                <img :src="'storage/games/' + team.game.id + '/jaquette.png'" alt="" class="game-jaquette">
              </div>
              <h4> {{ team.game.description }}</h4>
            </div>
          </div>
          <router-link to="/mon-equipe/edit" tag="button" class="btn-gamejam mr-4" exact>Modifier votre équipe</router-link>
          <button v-on:click="leaveTeam()" type="button" class="btn-gamejam" name="button">Quitter l'équipe</button>
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

export default {

  data(){
    return {
      team : null,
    }
  },

  created() {
    var _this = this;
    axios.get('/api/student.team')
    .then(function(response){
        _this.team = response.data[0];
    })
    .catch(function(error){
      if(error.response.status == 402){
        location.reload();
      }
    });
  },

  methods:{
    leaveTeam(){
      var _this = this;
      axios.patch('/api/student.team.leave')
      .then(function(response){
          _this.team = null;
          _this.$store.commit('setTeam', null);
      })
      .catch(function(error){
        if(error.response.status == 402){
          location.reload();
        }
      });
    }
  }
}
</script>

<style lang="css">
  .upload-zip{
    cursor: pointer;
    user-select: none;
    transition: all 0.5s ease-in-out;
    height:300px;
    width:300px;
    padding:auto;
    text-align: center;
    vertical-align: middle;
    line-height: 300px;
    background:#686868;
    color:white;
    margin-bottom: 0.5rem;
  }
  .upload-zip:hover{
    transition: all 0.5s ease-in-out;
    background:#535353;
    color:white;
  }
  .game-jaquette{
    height:300px;
    width:300px;
    margin-bottom: 0.5rem;
  }
</style>
