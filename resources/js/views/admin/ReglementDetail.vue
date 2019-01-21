<template>
  <div class="container">
    <button type="button" class="btn btn-primary mb-3" @click="goBack">Retour</button>
    <div v-if="rule">
      <div class="alert alert-danger" v-if="errors.length > 0">
        <ul class="mb-0">
          <li v-for="error in errors">{{ error[0] }}</li>
        </ul>
      </div>
      <h3>Modifier la règle</h3>
      <form @submit.prevent="submit">
        <div class="form-group">
          <label for="rulename">Nom de la règle</label>
          <input type="text" v-model="rule.name" class="form-control" id="rulename" placeholder="Entrer un nom...">
        </div>
        <div class="form-group">
          <label for="ruledescription">Description de la règle</label>
          <textarea type="text" v-model="rule.description" class="form-control" id="ruledescription" placeholder="Entrer une description" style="min-height:200px"/>
        </div>
        <button type="submit" class="btn btn-success">Sauvegarder</button>
      </form>
    </div>
    <div v-else class="alert alert-danger">
      Cette règle n'existe pas.
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      rule : null,
      errors : [],
    }
  },

  mounted() {
    axios.get('/api/admin.getRule', {params : { id: this.$route.params.id } })
    .then((response) => {
      this.rule = response.data;
    });
  },

  methods:{
    goBack(){
      this.$router.go(-1);
    },
    submit(){
      this.errors = [];
      axios.post('/api/admin.rule.update', this.rule)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
      })
      .catch((error) => {
        this.errors = Object.values(error.response.data.errors);
      });
    }
  }
}
</script>

<style lang="css">
</style>
