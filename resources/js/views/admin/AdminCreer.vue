<template>
  <div class="container">
    <button type="button" class="btn btn-primary mb-3" @click="goBack">Retour</button>
    <div class="alert alert-danger" v-if="errors.length > 0">
      <ul class="mb-0">
        <li v-for="error in errors">{{ error[0] }}</li>
      </ul>
    </div>
    <h3>Ajouter un administrateur</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="rulename">Login CAS</label>
        <input type="text" v-model="admin.login" class="form-control" id="adminlogin" placeholder="Entrer un login CAS valide...">
      </div>
      <div class="form-group">
        <label for="adminfirstname">Prénom</label>
        <input type="text" v-model="admin.first_name" class="form-control" id="adminfirstname" placeholder="Entrer un prénom..."/>
      </div>
      <div class="form-group">
        <label for="adminlastname">Nom</label>
        <input type="text" v-model="admin.last_name" class="form-control" id="adminlastname" placeholder="Entrer un nom..." />
      </div>
      <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
  </div>
</template>

<script>
export default {

  data(){
    return {
      admin : {
        login : '',
        first_name : '',
        last_name : '',
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
      axios.post('/api/admin.admin.create', this.admin)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
        this.$router.push('/admin/admins');
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
