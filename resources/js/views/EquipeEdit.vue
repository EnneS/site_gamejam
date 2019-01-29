<template>
  <div class="">
    <div class="row bg-dark pt-5 pb-5 text-white" style="height:100%">
      <div class="container">
        <h1>Modifier mon équipe</h1>
        <div class="alert alert-danger" v-if="error != null">
          <div v-for="error in error['jaquette']">
            {{error}}
          </div>
          <div v-for="error in error['zip']">
            {{error}}
          </div>
        </div>
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
            <div class="form-row form-group">
              <div class="col">
                <label for="file-upload">Jaquette du jeu (jpeg, png | 300px * 300px)</label>
                <div class="custom-file mb-2" id="file-upload">
                  <input v-on:change="handleFileUpload('jaquette')" ref='jaquette' type="file" class="custom-file-input" id="inputGroupFile04">
                  <label class="custom-file-label" for="inputGroupFile04" style="line-height:2;">{{ files['jaquette'].name }}</label>
                </div>
                <button type="button" class="btn-gamejam btn-sm float-right" style="height:35px" name="button" @click="clearJaquette">Vider la jaquette</button>
              </div>
              <div class="col">
                <label for="file-upload">ZIP du jeu</label>
                <div class="custom-file mb-2" id="file-upload">
                  <input v-on:change="handleFileUpload('zip')" ref='zip' type="file" class="custom-file-input" id="inputGroupFile04">
                  <label class="custom-file-label" for="inputGroupFile04" style="line-height:2;">{{ files['zip'].name }}</label>
                </div>
                <button type="button" class="btn-gamejam btn-sm float-right" style="height:35px" name="button" @click="clearZip">Vider le ZIP</button>
              </div>
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
      files:{
        'jaquette': {
          name: 'Sélectionner une jaquette..',
          file: null,
        },
        'zip': {
          name: 'Sélectionner un .zip..',
          file: null,
        }
      },
      error : null,
    }
  },

  created() {
    var _this = this;
    axios.get('/api/student.team')
    .then(function(response){
        _this.team = response.data.team;
    });
  },

  methods:{
    // Retrieve the file (when selected with <input>)
    handleFileUpload(type){
      this.files[type].file = this.$refs[type].files[0];
      this.files[type].name = this.$refs[type].files[0].name;
    },

    onSubmit(){
      let formData = new FormData();
      formData.append('teamName', this.team.name);
      formData.append('gameName', this.team.game.name);
      formData.append('gameDesc', this.team.game.description);
      formData.append('jaquette', this.files['jaquette'].file);
      formData.append('zip', this.files['zip'].file);


      var _this = this;
      axios.post('/api/team.edit', formData)
        .then(function(response){
            _this.$router.push('/mon-equipe');
        })
        .catch(function(error){
          _this.error = error.response.data.errors
          console.log(_this.error);
          if(error.response.status == 402){
            location.reload();
          }
        });
    },
    clearJaquette(){
      this.files['jaquette'].file = null;
      this.files['jaquette'].name = 'Sélectionner une jaquette..';
    },
    clearZip(){
      this.files['zip'].file = null;
      this.files['zip'].name = 'Sélectionner un .zip..';
    }
  }
}
</script>

<style lang="css">
</style>
