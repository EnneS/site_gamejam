<template lang="html">
  <div>
    <navDark/>
    <div class="row bg-dark pt-5 pb-5">
      <div class="container">
        <h1 class="mb-5 text-white">Equipes</h1>

        <div v-if="teams != []" class="row d-flex justify-content-between">
          <div class="card mb-5" style="width: 18rem;" v-for="team in teams">
            <div class="card-header">
              {{ team.name }}
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item" v-for="student in team.students">{{ student.first_name }} {{ student.last_name}}</li>
            </ul>
            <button v-if="isJoinable(team.id)" v-on:click="joinTeam(team.id)" class="btn-gamejam btn-vert" type="button" name="button">Rejoindre</button>
            <button v-if="isLeavable(team.id)" v-on:click="leaveTeam(team.id)" class="btn-gamejam btn-vert" type="button" name="button">Quitter</button>
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
          if(response.status == 200){
            _this.getTeams();
            _this.$store.commit('setTeam', response.data);
          }
      });
    },

    leaveTeam(){
      var _this = this;
      axios.patch('/api/student.team.leave')
      .then(function(response){
        if(response.status == 200){
          _this.getTeams();
          _this.$store.commit('setTeam', null);
        }
      });
    },

    isJoinable(){
      return this.$store.getters.check && !this.$store.getters.team;
    },

    isLeavable(id){
      return this.$store.getters.team_id == id;
    }
  }
}
</script>

<style lang="css">
</style>
