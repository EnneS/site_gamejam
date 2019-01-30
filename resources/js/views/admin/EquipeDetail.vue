<template>
  <div class="container">
    <button type="button" class="btn btn-primary mb-3" @click="goBack">Retour</button>
    <div v-if="team">
      <div v-if="!team.game.jaquette_uploaded || !team.game.zip_uploaded" class="row alert alert-danger">
        <ul class="mb-0">
          <li v-if="!team.game.jaquette_uploaded">Cette équipe n'a pas encore de jaquette.</li>
          <li v-if="!team.game.zip_uploaded">Cette équipe n'a pas encore envoyé son ZIP.</li>
        </ul>
      </div>
      <div class="row d-block" v-if="team.group_id != null">
        <h3>Poule numéro {{ team.group_id }}</h3>
        <h4><span class="badge badge-pill badge-success">Salle {{ team.group.name }}</span></h4>
      </div>
      <!-- l'équipe, ses membres -->
      <div class="row mb-4">
        <div class="col-sm card p-4 mr-3">
          <h2>Nom de l'équipe : {{ team.name }}</h2>
          <h5>Membres</h5>
          <ul class="list-group text-dark">
            <li class="list-group-item" v-for="student in team.students">{{ student.first_name }} {{ student.last_name}}</li>
          </ul>
        </div>
        <!-- le jeu -->
        <div class="col-sm card p-4">
          <div>
            <h2>Nom du jeu : {{ team.game.name }}</h2>
            <!-- jaquette du jeu -->
            <div v-if="team.game.jaquette_uploaded">
                <img :src="'/storage/games/' + gameYear + '/' + team.game.hash + '/jaquette.png'" alt="" class="game-jaquette">
            </div>
            <h4>Description du jeu : {{ team.game.description }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="alert alert-danger">
      Cette équipe n'existe pas.
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      team : null,
      errors : [],
    }
  },

  computed: {
    gameYear(){
      let date;
      if(this.team != null){
        let splittedDate = this.team.created_at.split('-');
        date = splittedDate[0];
      } else {
        date = new Date().getFullYear();
      }
      return date;
    }
  },

  mounted() {
    axios.get('/api/admin.getTeam', {params : { id: this.$route.params.id } })
    .then((response) => {
      this.team = response.data;
    });
  },

  methods:{
    goBack(){
      this.$router.go(-1);
    },
  }
}
</script>

<style lang="css">
</style>
