<template>
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
        <div v-for="error in error['pdf']">
          {{error}}
        </div>
      </div>
      <div class="container mt-4 p-0" v-if="team != null">
        <form v-on:submit.prevent="onSubmit">
          <div class="row">
            <div class="col-sm">
              <h2>Informations</h2>
              <div class="form-group">
                <label for="exampleInputEmail1">Nom de l'équipe</label>
                <input v-model="team.name" type="text" class="form-control" placeholder="Comment votre équipe s'appellera..." required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Nom du jeu</label>
                <input v-model="team.game.name" type="text" class="form-control" placeholder="Le nom que vous avez choisi pour votre jeu...">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Description du jeu</label>
                <input v-model="team.game.description" type="text" class="form-control" placeholder="Une courte description de votre jeu...">
              </div>
            </div>
            <div class="col-sm">
              <h2>Livrables</h2>
              <div class="form-group">
                <label for="file-upload">Jaquette du jeu (jpeg, png | 300px * 300px)</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input v-on:change="handleFileUpload('jaquette')" ref='jaquette' type="file" class="custom-file-input" id="inputGroupFile04">
                    <label class="custom-file-label" for="inputGroupFile04" style="line-height:2;">{{ files['jaquette'].name }}</label>
                  </div>
                  <div class="input-group-append" @click="clearJaquette" style="cursor:pointer;">
                    <span class="input-group-text" id="">Vider la jaquette</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="file-upload">ZIP du jeu</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input v-on:change="handleFileUpload('zip')" ref='zip' type="file" class="custom-file-input" id="inputGroupFile04">
                    <label class="custom-file-label" for="inputGroupFile04" style="line-height:2;">{{ files['zip'].name }}</label>
                  </div>
                  <div class="input-group-append" @click="clearZip" style="cursor:pointer;">
                    <span class="input-group-text" id="">Vider le ZIP</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="file-upload">PDF de la présentation</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input v-on:change="handleFileUpload('pdf')" ref='pdf' type="file" class="custom-file-input" id="inputGroupFile04">
                    <label class="custom-file-label" for="inputGroupFile04" style="line-height:2;">{{ files['pdf'].name }}</label>
                  </div>
                  <div class="input-group-append" @click="clearPdf" style="cursor:pointer;">
                    <span class="input-group-text" id="">Vider le PDF</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn-gamejam">Valider</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return{
      team: {
        name: '',
        game: {
          name: '',
          description: '',
        }
      },
      files:{
        'jaquette': {
          name: 'Sélectionner une jaquette..',
          file: null,
        },
        'zip': {
          name: 'Sélectionner un .zip..',
          file: null,
        },
        'pdf': {
          name: 'Sélectionner un .pdf..',
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
      formData.append('gameName', this.team.game.name == null ? '' : this.team.game.name);
      formData.append('gameDesc', this.team.game.description == null ? '' : this.team.game.description);
      formData.append('jaquette', this.files['jaquette'].file);
      formData.append('zip', this.files['zip'].file);
      formData.append('pdf', this.files['pdf'].file);


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
    },
    clearPdf(){
      this.files['pdf'].file = null;
      this.files['pdf'].name = 'Sélectionner un .pdf..';
    }
  }
}
</script>

<style lang="css">
</style>
