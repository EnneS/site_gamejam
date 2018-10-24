<template lang="html">
  <div class="">
    <navDark/>
    <div class="row bg-dark pt-5 pb-5 text-white" style="height:100%">
      <div class="container">
        <h1>Créer mon équipe</h1>
        <div class="container mt-4">
          <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
              <label for="exampleInputEmail1">Nom de l'équipe</label>
              <input v-model="form.teamName" type="text" class="form-control" placeholder="Comment votre équipe s'appellera...">
              <small class="form-text text-white">Vous pourrez le modifier par la suite.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Nom du jeu</label>
              <input v-model="form.gameName" type="text" class="form-control" placeholder="Le nom que vous avez choisi pour votre jeu...">
              <small class="form-text text-white">Vous pourrez le modifier par la suite.</small>
            </div>
            <button type="submit" class="btn-gamejam">Créer votre équipe</button>
          </form>
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
      form:{
        teamName : "",
        gameName : "",
      }
    }
  },

  created() {
    this.checkIfTeam();
  },

  methods:{
    onSubmit(){
      let formData = new FormData();

      formData.append('teamName', this.form.teamName);
      formData.append('gameName', this.form.gameName);

      axios.post('/api/team.create', formData)
        .then(function(response){
          console.log(reponse);
        });
    },

    checkIfTeam(){
      var _this = this;
      axios.get('/api/student.team')
      .then(function(response){
        if(response.data != ""){
          console.log("du vent");
          _this.$router.push('/mon-equipe');
        }
      });
    }
  }
}
</script>

<style lang="css">
</style>
