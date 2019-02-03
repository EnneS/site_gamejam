<template>
  <div class="container">
    <button type="button" class="btn btn-primary mb-3" @click="goBack">Retour</button>
    <div class="alert alert-danger" v-if="errors.length > 0">
      <ul class="mb-0">
        <li v-for="error in errors">{{ error[0] }}</li>
      </ul>
    </div>
    <h3>Ajouter un étudiant</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="rulename">Login CAS</label>
        <input type="text" v-model="student.login" class="form-control" id="studentlogin" placeholder="Entrer un login CAS valide..." required>
      </div>
      <div class="form-group">
        <label for="adminfirstname">Prénom</label>
        <input type="text" v-model="student.first_name" class="form-control" id="studentfirstname" placeholder="Entrer un prénom..." required/>
      </div>
      <div class="form-group">
        <label for="adminlastname">Nom</label>
        <input type="text" v-model="student.last_name" class="form-control" id="studentlastname" placeholder="Entrer un nom..." required/>
      </div>
      <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
  </div>
</template>

<script>
export default {

  data(){
    return {
      student : {
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
      axios.post('/api/admin.student.create', this.student)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
        this.$router.push('/admin/etudiants');
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
