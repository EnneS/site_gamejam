<template>
  <div class="container">
    <h3>Liste des Poules</h3>
    <div class="admin-box">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Salle</th>
            <th scope="col">Nombre d'équipes</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups">
            <th scope="row">{{ group.id }}</th>
            <td>{{ group.name }}</td>
            <td>{{ group.teams_count }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="form-group w-25">
      <label for="nbGroups">Nombre de poules</label>
      <input type="number" v-model.number="nbGroups" value="" name="nbGroups" class="form-control" placeholder="Nombre de poule..." />
      <label for="teampergroup">Nombre d'équipes par poule</label>
      <input type="number" v-model.number="teamsPerGroup" value="" name="teampergroup" class="form-control" placeholder="Nombre d'équipes par poule..." />
      <button type="button" class="mt-2 btn btn-primary" @click="generateGroups()">Générer les poules</button>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      groups : [],
      teamsPerGroup : 0,
      nbGroups : 0,
    }
  },

  mounted() {
    axios.get('/api/admin.groups')
    .then((response) => {
      this.groups = response.data;
    });
  },

  methods:{
    generateGroups(){
      axios.get('/api/admin.groups.generate', {params : { teamsPerGroup : this.teamsPerGroup, nbGroups : this.nbGroups }})
      .then((response) => {
        this.groups = response.data.groups;
        this.$toasted.success(response.data.message, {duration : 2000});
      }).catch((error) => {
        this.$toasted.error(error.response.data.message, {duration : 2000});
      })
    }
  }
}
</script>

<style lang="css">
</style>
