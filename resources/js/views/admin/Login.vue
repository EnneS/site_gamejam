<template lang="html">
  <div class="">
    <div class="row bg-dark pt-5 pb-5 justify-content-center">
      <div class="col-4">
        <div class="container">
          <div class="card">
            <div class="card-body">
              <div class="alert alert-danger" v-if="error != ''">
                {{ error }}
              </div>
              <form @submit.prevent="submit">
                <div class="form-group">
                  <label for="passwordInput">Mot de passe</label>
                  <input type="password" class="form-control" v-model="password" id="passwordInput" placeholder="Entrer le mot de passe...">
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
              </form>
            </div>
          </div>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      password: '',
      error : '',
    }
  },

  mounted() {
  },

  methods:{
    submit(){
      this.error = '';
      axios.post('/api/admin.login', {password: this.password})
      .then((response) => {
        this.$store.commit('setUser', response.data);
        this.$router.push({ path: '/admin/' })

      })
      .catch((error) => {
        this.error = error.response.data.message;
      })
    }
  }
}
</script>

<style lang="css">
</style>
