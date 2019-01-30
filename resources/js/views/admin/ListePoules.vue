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
    <h3>Génération des Poules</h3>
    <div class="form-group w-50 card p-2">
      <label for="nbGroups" class="mb-0">Nombre de poules</label>
      <input type="number" v-model.number="nbGroups" value="" name="nbGroups" class="form-control mb-2" placeholder="Nombre de poule..." />
      <label for="teampergroup" class="mb-0">Nombre d'équipes par poule</label>
      <input type="number" v-model.number="teamsPerGroup" value="" name="teampergroup" class="form-control mb-2" placeholder="Nombre d'équipes par poule..." />
      <label for="nbGroups" class="mb-0">Noms des salles séparés par une virgule</label>
      <input type="text" v-model="groupsNames" value="" name="nbGroups" id="groupsNames" class="form-control" placeholder="Nom des poules..." required/>
      <small id="groupsNames" class="mb-2 mt-0 form-text text-muted float-right">Par exemple : 104,201,110,115,215</small>
      <button type="button" class="mt-2 btn btn-success" @click="generateGroups()">Générer les poules</button>
      <hr>
      <button type="button" class="btn btn-danger" @click="deleteGroups()">Supprimer les poules</button>
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
      groupsNames : '',
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
      axios.get('/api/admin.groups.generate', {params : { teamsPerGroup : this.teamsPerGroup, nbGroups : this.nbGroups, groupsNames : this.groupsNames }})
      .then((response) => {
        this.groups = response.data.groups;
        this.$toasted.success(response.data.message, {duration : 2000});
      }).catch((error) => {
        this.$toasted.error(error.response.data.message, {duration : 2000});
      })
    },
    deleteGroups(){
      axios.post('/api/admin.groups.delete')
      .then((response) => {
        this.groups = [];
        this.$toasted.success(response.data.message, {duration : 2000});
      });
    }
  }
}
</script>

<style lang="css">
</style>
