<template lang="html">
  <div class="">
    <div class="row bg-dark pt-5 pb-5 text-white" style="height:100%">
      <div class="container">
        <h1>Modifier mon équipe</h1>
        <div class="container mt-4" v-if="team != null">
          <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
              <label for="exampleInputEmail1">Nom de l'équipe</label>
              <input v-model="team.name" type="text" class="form-control" placeholder="Comment votre équipe s'appellera..." required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Nom du jeu</label>
              <input v-model="team.game.name" type="text" class="form-control" placeholder="Le nom que vous avez choisi pour votre jeu..." required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description du jeu</label>
              <input v-model="team.game.description" type="text" class="form-control" placeholder="Une courte description de votre jeu..." required>
            </div>
            <button type="submit" class="btn-gamejam">Valider</button>
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
      team: null,
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
    onSubmit(){
      let formData = new FormData();
      formData.append('teamName', this.team.name);
      formData.append('gameName', this.team.game.name);
      formData.append('gameDesc', this.team.game.description);

      var _this = this;
      axios.post('/api/team.edit', formData)
        .then(function(response){
            _this.$router.push('/mon-equipe');
        })
        .catch(function(error){
          if(error.response.status == 402){
            location.reload();
          }
        });
    },
  }
}
</script>

<style lang="css">
</style>
