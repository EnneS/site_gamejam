<template>
  <div class="container">
    <div class="row ">
      <div class="col-sm p-0">
        <button type="button" class="btn btn-primary mb-3" @click="goBack">Retour</button>
        <button type="button" v-if="team" class="btn btn-success mb-3" @click="updateTeam">Sauvegarder</button>
        <button type="button" v-if="team" name="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#confirmationModal">Supprimer l'équipe</button>
      </div>

    </div>
    <div v-if="team">
      <div class="alert alert-danger" v-if="errors.length > 0">
        <ul class="mb-0">
          <li v-for="error in errors">{{ error[0] }}</li>
        </ul>
      </div>
      <div v-if="!team.game.jaquette_uploaded || !team.game.zip_uploaded" class="row alert alert-danger">
        <ul class="mb-0">
          <li v-if="!team.game.jaquette_uploaded">Cette équipe n'a pas encore de jaquette.</li>
          <li v-if="!team.game.zip_uploaded">Cette équipe n'a pas encore envoyé son ZIP.</li>
          <li v-if="!team.game.pdf_uploaded">Cette équipe n'a pas encore envoyé son PDF.</li>
        </ul>
      </div>
      <div class="row d-block" v-if="team.group_id != null">
        <h3>Poule numéro {{ team.group_id }}</h3>
        <h4><span class="badge badge-pill badge-success">Salle {{ team.group.name }}</span></h4>
      </div>
      <!-- l'équipe, ses membres -->
      <div class="row mb-3">
          <div class="col-sm card p-4 mr-3">
            <label for="teamname" class="mb-0">Nom de l'équipe</label>
            <input type="text" v-model="team.name" class="form-control mb-2 form-control-lg" id="teamname" placeholder="Nom de léquipe..." required>
            <h5>Membres</h5>
            <ul class="list-group text-dark">
              <li class="list-group-item" v-for="student in team.students">{{ student.first_name }} {{ student.last_name}}</li>
            </ul>
          </div>
          <!-- le jeu -->
          <div class="col-sm card p-4">
            <div>
              <label for="gamename" class="mb-0">Nom du jeu</label>
              <input type="text" v-model="team.game.name" class="form-control mb-2 form-control-lg" id="gamename" placeholder="Nom du jeu...">
              <!-- jaquette du jeu -->
              <div v-if="team.game.jaquette_uploaded">
                  <img :src="'/storage/games/' + gameYear + '/' + team.game.hash + '/jaquette.png'" alt="" class="game-jaquette">
              </div>
              <label for="gamedesc" class="mb-0">Description du jeu</label>
              <textarea type="text" v-model="team.game.description" class="form-control mb-2" id="gamedesc" placeholder="Description du jeu..."/>
            </div>
          </div>
      </div>
      <div class="row">
        <a v-if="team.game.zip_uploaded" class="text-white btn btn-primary mr-1" :href="'/storage/games/' + gameYear + '/' + team.game.hash + '/zip.zip'">Télécharger le .zip</a>
        <a v-if="team.game.pdf_uploaded" class="text-white btn btn-primary" :href="'/storage/games/' + gameYear + '/' + team.game.hash + '/presentation.pdf'">Télécharger le PDF</a>
      </div>

    </div>
    <div v-else class="alert alert-danger">
      Cette équipe n'existe pas.
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Non">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Etes-vous sûr de vouloir supprimer cette équipe ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-success" @click="deleteTeam">Oui, supprimer l'équipe</button>
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
    updateTeam(){
      axios.post('/api/admin.team.update', this.team)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
      })
      .catch((error) => {
        this.errors = Object.values(error.response.data.errors);
      });
    },
    deleteTeam(){
      axios.post('/api/admin.team.delete', this.team)
      .then((response) => {
        this.$router.go(-1);
        this.$toasted.success(response.data.message, {duration : 2000});
      })
    }
  }
}
</script>

<style lang="css">
</style>
