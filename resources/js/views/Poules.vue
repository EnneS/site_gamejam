<template>
  <div class="row bg-dark pt-5 pb-5">
    <div class="container">
      <h1 class="mb-5 text-white">Poules</h1>

      <div v-if="groups.length > 0" class="row d-flex justify-content-between">
        <div class="card mb-5" style="width: 18rem;" v-for="group in groups">
          <div class="card-header">
            Salle {{ group.name }}
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="team in group.teams">{{ team.name }}</li>
          </ul>
        </div>
      </div>
      <div v-else class="alert alert-info">
        Les poules n'ont pas encore été créées.
      </div>
    </div>
  </div>
</template>

<script>

export default {

  data(){
    return{
        groups : [],
    }
  },

  mounted() {
    var _this = this;
    axios.get('/api/groups')
    .then(function(response){
      _this.groups = response.data;
    });
  }
}
</script>

<style lang="css">
</style>
