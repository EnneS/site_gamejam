<template>
  <div class="container">
    <button type="button" class="btn btn-primary mb-3" @click="goBack">Retour</button>
    <div class="alert alert-danger" v-if="errors.length > 0">
      <ul class="mb-0">
        <li v-for="error in errors">{{ error[0] }}</li>
      </ul>
    </div>
    <h3>Ajouter une étape au tutoriel</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="stepname">Nom de l'étape</label>
        <input type="text" v-model="step.name" class="form-control" id="stepname" placeholder="Entrer un nom..." required>
      </div>
      <div class="form-group">
        <label for="ruledescription">Description de l'étape</label>
        <textarea type="text" v-model="step.description" class="form-control" id="stepdescription" placeholder="Entrer une description" style="min-height:200px" required/>
      </div>
      <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
  </div>
</template>

<script>
export default {

  data(){
    return {
      step : {
        name : '',
        description : '',
      },
      errors : [],
    }
  },

  mounted() {

  },

  methods:{
    goBack(){
      this.$router.go(-1);
    },
    submit(){
      this.errors = [];
      axios.post('/api/admin.step.create', this.step)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
        this.$router.push('/admin/tutoriel');
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
