<template>
  <div class="container">
    <h3>
      Liste des équipes
      <span class="ml-2 badge badge-primary badge-pill" style="font-size:0.5em">{{ teams.length }} équipes</span>
      <span class="ml-2 badge badge-primary badge-pill" style="font-size:0.5em">{{ studentsWithTeamCount }} étudiants dans une équipe</span>
      <button type="button" name="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#confirmationModal">Supprimer les équipes</button>
    </h3>

    <div class="admin-box">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Poule</th>
            <th scope="col">Zip</th>
            <th scope="col">Jaquette</th>
            <th scope="col">Nombre de membres</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="team in teams">
            <th scope="row">{{ team.id }}</th>
            <td>{{ team.name }}</td>
            <td>{{ team.group_id }}</td>
            <td>
              <span v-if="team.game.zip_uploaded == 1" class="text-success">Oui</span>
              <span v-else class="text-danger">Non</span>
            </td>
            <td>
              <span v-if="team.game.jaquette_uploaded == 1" class="text-success">Oui</span>
              <span v-else class="text-danger">Non</span>
            </td>
            <td>{{ team.students_count }}</td>
            <td><button type="button" class="btn btn-sm btn-primary" @click="seeMore(team.id)">Plus d'info</button></td>
           </tr>
        </tbody>
      </table>
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
            Etes-vous sûr de vouloir supprimer la totalité des équipes ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-success" @click="deleteTeams">Oui, supprimer les équipes</button>
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
      teams : [],
      studentsWithTeamCount : 0,
    }
  },

  mounted() {
    axios.get('/api/admin.teams')
    .then((response) => {
      this.teams = response.data.teams;
      this.studentsWithTeamCount = response.data.studentsCount;
    });
  },

  methods:{
    seeMore(id){
      this.$router.push({path :'/admin/equipes/' + id});
    },
    deleteTeams(){
      $('#confirmationModal').modal("hide");
      axios.post('/api/admin.teams.delete')
      .then((response) => {
        this.teams = [];
        this.$toasted.success(response.data.message, {duration : 2000});
      });
    }
  }
}
</script>

<style lang="css">
</style>
