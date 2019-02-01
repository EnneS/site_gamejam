<template>
  <div class="container">
    <h3>Liste des administrateurs</h3>
    <div v-for="admin in admins" class="row align-items-center">
      <div class="col-sm">
        <div class="card mb-2" >
          <div class="card-body">
            <h6 class="mb-0" style="font-weight:700">{{ admin.first_name }} {{ admin.last_name }}</h6>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-danger" v-if="admin.id != getUser.id" @click="deleteAdmin(admin.id)">Supprimer</button>
      </div>
    </div>
    <button type="button" class="btn btn-success" @click="addRule()">+</button>
  </div>
</template>

<script>
export default {

  data(){
    return {
      admins : []
    }
  },

  computed:{
    getUser(){
      return this.$store.getters.user;
    }
  },

  mounted() {
    axios.get('/api/admin.admins')
    .then((response) => {
      this.admins = response.data;
    });
  },

  methods:{
    addRule(){
      this.$router.push({path:'/admin/new/admin'});
    },
    deleteAdmin(id){
      axios.post('/api/admin.admin.delete', {id : id})
      .then((response) => {
        // Delete the rule in the array
        let i = 0;
        while(i < this.admins.length && this.admins[i].id != id){
          i++;
        }
        this.admins.splice(i, 1);

        // Display success message
        this.$toasted.success(response.data.message, {duration : 2000});
      })
      .catch((error) => {
        // Display error message
        this.$toasted.error(error.response.data.message, {duration : 2000});
      });
    }
  }
}
</script>

<style lang="css">
</style>
