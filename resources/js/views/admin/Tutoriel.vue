<template lang="html">
  <div class="container">
    <h3>Tutoriel</h3>
    <div v-for="step in steps" class="row align-items-center">
      <div class="col-sm">
        <div class="card mb-2" >
          <div class="card-body">
            <h6 class="mb-0" style="font-weight:700">{{ step.name }}</h6>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-primary" @click="editStep(step.id)">Editer</button>
        <button type="button" class="btn btn-danger" @click="deleteStep(step.id)">Supprimer</button>
      </div>
    </div>
    <button type="button" class="btn btn-success" @click="addStep()">+</button>
  </div>
</template>

<script>
export default {

  data(){
    return {
      steps:[],
    }
  },

  mounted() {
    axios.get('/api/admin.steps')
    .then((response) => {
      this.steps = response.data;
    });
  },

  methods:{
    addStep(){
      this.$router.push({path:'/admin/new/tutoriel'});
    },
    editStep(id){
      this.$router.push({path:'/admin/tutoriel/' + id});
    },
    deleteStep(id){
      axios.post('/api/admin.step.delete', {id : id})
      .then((response) => {
        // Delete the rule in the array
        let i = 0;
        while(i < this.steps.length && this.steps[i].id != id){
          i++;
        }
        this.steps.splice(i, 1);
      });
    }
  }
}
</script>

<style lang="css">
</style>
