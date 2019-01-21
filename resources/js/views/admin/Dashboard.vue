<template>
  <div class="container">
    <h3>Dashboard</h3>
    <div class="row">
      <div class="col-sm-4">
        <h5>Configuration</h5>
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="submitConfiguration()">
              <div class="form-group">
                <label for="studentperteam">Nombre maximum d'étudiants par équipe</label>
                <input type="number" v-model="configuration.studentsPerTeam" class="form-control" id="studentperteam" placeholder="Nombre maximum d'étudiants par équipe...">
              </div>
              <div class="form-group">
                <label for="maxteamcount">Nombre maximum d'équipes</label>
                <input type="number" v-model="configuration.maxTeamCount" class="form-control" id="maxteamcount" placeholder="Nombre maximum d'équipes...">
              </div>
              <button type="submit" class="btn btn-success" name="button">Sauvegarder</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <h5>Notification</h5>
        <div class="card">
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {

  data(){
    return {
      configuration:{
        studentsPerTeam : 0,
        maxTeamCount : 0,
      }
    }
  },

  mounted() {
    axios.get('/api/admin.configuration')
    .then((response) => {
      this.configuration.studentsPerTeam = response.data.studentsPerTeam;
      this.configuration.maxTeamCount = response.data.maxTeamCount;
    });
  },

  methods:{
    submitConfiguration(){
      axios.post('/api/admin.configuration.update', this.configuration)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
      })
      .catch((error) => {
        console.log(error.response);
      });
    }
  }
}
</script>

<style lang="css">
</style>
