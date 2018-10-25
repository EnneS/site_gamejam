<template lang="html">
  <div class="">
    <div class="row bg-dark pt-5 pb-5">
      <div class="container">
        <div v-if="groups != []" class="row d-flex justify-content-between">
          <div class="card mb-5" style="width: 18rem;" v-for="group in groups">
            <div class="card-header">
              Salle {{ group.name }}
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item" v-for="team in group.teams">{{ team.name }}</li>
            </ul>
          </div>
        </div>
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
