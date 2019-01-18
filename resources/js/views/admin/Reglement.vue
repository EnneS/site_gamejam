<template lang="html">
  <div class="container">
    <h3>Règlement</h3>
    <div v-for="rule in rules" class="row align-items-center">
      <div class="col-sm">
        <div class="card mb-2" >
          <div class="card-body">
            <h6 class="mb-0" style="font-weight:700">{{ rule.name }}</h6>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-primary" @click="editRule(rule.id)">Editer</button>
        <button type="button" class="btn btn-danger" @click="deleteRule(rule.id)">Supprimer</button>
      </div>
    </div>
    <button type="button" class="btn btn-success" @click="addRule()">+</button>
  </div>
</template>

<script>
export default {

  data(){
    return {
      rules : []
    }
  },

  mounted() {
    axios.get('/api/admin.rules')
    .then((response) => {
      this.rules = response.data;
    });
  },

  methods:{
    addRule(){
      this.$router.push({path:'/admin/new/reglement'});
    },
    editRule(id){
      this.$router.push({path:'/admin/reglement/' + id});
    },
    deleteRule(id){
      axios.post('/api/admin.rule.delete', {id : id})
      .then((response) => {
        // Delete the rule in the array
        let i = 0;
        while(i < this.rules.length && this.rules[i].id != id){
          i++;
        }
        this.rules.splice(i, 1);
      });
    }
  }
}
</script>

<style lang="css">
</style>
