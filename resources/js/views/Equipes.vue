<template>
  <div>
    <div class="row bg-dark pt-5 pb-5">
      <div class="container">
        <h1 class="mb-5 text-white">Equipes</h1>

        <div v-if="teams != []" class="row d-flex justify-content-between">
          <div class="card mb-5" style="width: 18rem;" v-for="team in teams">
            <div class="card-header d-flex justify-content-between">
              <span>{{ team.name }}</span>
              <span v-if="alreadyRequested(team.id)" class="badge badge-pill badge-primary" style="line-height:1.6">Demande envoyée</span>
            </div>
            <div class="card-body p-0 d-flex flex-column">
              <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="student in team.students">{{ student.first_name }} {{ student.last_name}}</li>
              </ul>
              <div class="mt-auto">
              <button v-if="isJoinable(team.id)" v-on:click="joinTeam(team.id)" class="btn-gamejam btn-vert w-100" type="button" name="button">Rejoindre</button>
              <button v-if="isLeavable(team.id)" v-on:click="leaveTeam(team.id)" class="btn-gamejam btn-vert w-100" type="button" name="button">Quitter</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  data(){
    return{
      teams: [],
    }
  },

  mounted() {
    var _this = this;
    axios.get('/api/teams')
    .then(function(response){
      _this.teams = response.data;
    });
  },

  methods:{
    getTeams(){
      var _this = this;
      axios.get('/api/teams')
      .then(function(response){
        _this.teams = response.data;
      });
    },

    joinTeam(id){
      var _this = this;
      axios.post('/api/student.team.join', {
        teamId : id
      })
      .then(function(response){
        _this.$store.commit('addJoinRequest', response.data.joinRequest);
      })
      .catch(function(error){
        // Display error message
        _this.$toasted.error(error.response.data.message, {duration : 2000});
      });
    },

    leaveTeam(){
      var _this = this;
      axios.post('/api/student.team.leave')
      .then(function(response){
        if(response.status == 200){
          _this.getTeams();
          _this.$store.commit('setTeam', null);
        }
      })
      .catch(function(error){
        if(error.response.status == 402){
          location.reload();
        }
      });
    },

    alreadyRequested(id){
      let i = 0;
      let joinRequests = this.$store.state.user.join_requests;
      while(i < joinRequests.length && joinRequests[i].team_id != id){
        i++;
      }
      return i != joinRequests.length;
    },

    isJoinable(id){
      // IS JOINABLE IF :
      // is logged
      // is not an admin
      // has no team
      // has not already sent a join request

      return this.$store.getters.check && !this.$store.getters.admin && !this.$store.getters.team && !this.alreadyRequested(id);
    },

    isLeavable(id){
      return this.$store.getters.check && !this.$store.getters.admin && this.$store.getters.team_id == id;
    }
  }
}
</script>

<style lang="css">
</style>
