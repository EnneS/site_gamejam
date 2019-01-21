<template>
  <div class="container">
    <h3>Liste des équipes</h3>

    <div class="admin-box">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Poule</th>
            <th scope="col">Zip</th>
            <th scope="col">Jaquette</th>
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
            <td><button type="button" class="btn btn-sm btn-primary" @click="seeMore(team.id)">Plus d'info</button></td>
           </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      teams : []
    }
  },

  mounted() {
    axios.get('/api/admin.teams')
    .then((response) => {
      this.teams = response.data;
    });
  },

  methods:{
    seeMore(id){
      this.$router.push({path :'/admin/equipes/' + id});
    }
  }
}
</script>

<style lang="css">
</style>
