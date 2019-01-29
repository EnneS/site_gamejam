<template>
  <div class="">
    <div class="row bg-dark pt-5 pb-5 text-white">
      <div class="container">
        <h1 class="mb-3">Mon équipe</h1>
        <div v-if="this.team != null">
          <!-- l'équipe, ses membres -->
          <div class="row mb-4">
            <div class="col">
              <h2> {{ team.name }}</h2>

              <div v-if="team.join_requests.length > 0">
              <h5>Demandes d'adhésion</h5>
                <ul class="list-group text-dark mb-2">
                  <li class="list-group-item d-flex justify-content-between align-items-center" v-for="joinRequest in team.join_requests">
                    <span>{{ joinRequest.student.first_name }} {{ joinRequest.student.last_name }}</span>
                    <span>
                      <font-awesome-icon icon="check" class="text-success mr-3" @click="acceptJoinRequest(joinRequest.id)" style="cursor:pointer;"/>
                      <font-awesome-icon icon="times" class="text-danger" @click="declineJoinRequest(joinRequest.id)" style="cursor:pointer;"/>
                    </span>
                  </li>
                </ul>
              </div>

              <h5>Membres</h5>
              <ul class="list-group text-dark">
                <li class="list-group-item" v-for="student in team.students">{{ student.first_name }} {{ student.last_name}}</li>
              </ul>
            </div>

            <!-- le jeu -->
            <div class="col-sm d-flex align-items-end flex-column">
              <div>
                <h2> {{ team.game.name }}</h2>
                <!-- jaquette du jeu -->
                <div v-if="!team.game.jaquette_uploaded" class="upload-zip" @click="goToEdit()">
                  Ajouter une jaquette
                </div>
                <div v-else>
                    <img :src="'storage/games/' + team.game.hash + '/jaquette.png'" alt="" class="game-jaquette">
                </div>
                <h4> {{ team.game.description }}</h4>
              </div>
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
        _this.team = response.data.team;
        if(!_this.$store.getters.team)
        _this.$store.commit('setTeam', response.data.team.id);
    });
  },

  methods:{
    goToEdit(){
      this.$router.push('/mon-equipe/edit');
    },
    leaveTeam(){
      var _this = this;
      axios.post('/api/student.team.leave')
      .then(function(response){
          _this.team = null;
          _this.$store.commit('setTeam', null);
          _this.$store.commit('deleteJoinRequests');
      });
    },
    acceptJoinRequest(id){
      axios.post('/api/student.team.acceptRequest', {id : id})
      .then((response) => {
        let i = 0;
        while(i < this.team.join_requests.length && this.team.join_requests[i].id != id){
          i++;
        }
        // Add the student to the team students list
        this.team.students.push(this.team.join_requests[i].student);
        // Delete the join request
        this.team.join_requests.splice(i, 1);

        // Display success message
        this.$toasted.success(response.data.message, {duration : 2000});
      })
      .catch((error) => {
        // Display error message
        this.$toasted.error(error.response.data.message, {duration : 2000});
      });
    },
    declineJoinRequest(id){
      axios.post('/api/student.team.declineRequest', {id : id})
      .then((response) => {
        let i = 0;
        while(i < this.team.join_requests.length && this.team.join_requests[i].id != id){
          i++;
        }
        // Delete the join request
        this.team.join_requests.splice(i, 1);

        // Display success message
        this.$toasted.success(response.data.message, {duration : 2000});
      });
    }
  }
}
</script>
