<template lang="html">
  <div class="">
    <div class="row bg-dark pt-5 pb-5 text-white" style="height:100%">
      <div class="container">
        <h1>Créer mon équipe</h1>
        <div class="container mt-4">
          <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
              <label>Nom de l'équipe</label>
              <input v-model="form.teamName" type="text" class="form-control" placeholder="Comment votre équipe s'appellera..." required>
              <small class="form-text text-white">Vous pourrez le modifier par la suite.</small>
            </div>
            <div class="form-group">
              <label>Nom du jeu</label>
              <input v-model="form.gameName" type="text" class="form-control" placeholder="Le nom que vous avez choisi pour votre jeu..." required>
              <small class="form-text text-white">Vous pourrez le modifier par la suite.</small>
            </div>
            <div class="form-group">
              <label>Description du jeu</label>
              <input v-model="form.gameDesc" type="text" class="form-control" placeholder="Une courte description de votre jeu..." required>
              <small class="form-text text-white">Vous pourrez la modifier par la suite.</small>
            </div>
            <button type="submit" class="btn-gamejam">Créer votre équipe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return{
      form:{
        teamName : "",
        gameName : "",
        gameDesc : "",
      }
    }
  },

  created() {
  },

  methods:{
    onSubmit(){
      let formData = new FormData();

      formData.append('teamName', this.form.teamName);
      formData.append('gameName', this.form.gameName);
      formData.append('gameDesc', this.form.gameDesc);
      var _this = this;
      axios.post('/api/team.create', formData)
        .then(function(response){
            _this.$router.push('/mon-equipe');
            _this.$store.commit('setTeam', response.data.id);
        });
    },
  }
}
</script>

<style lang="css">
</style>
