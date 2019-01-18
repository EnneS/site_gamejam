<template lang="html">
  <div class="container">
    <h3>Liste des Poules</h3>

    <div class="admin-box">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Salle</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups">
            <th scope="row">{{ group.id }}</th>
            <td>{{ group.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      groups : []
    }
  },

  mounted() {
    axios.get('/api/admin.groups')
    .then((response) => {
      this.groups = response.data;
    });
  },

  methods:{
  }
}
</script>

<style lang="css">
  tbody tr:hover {
    background: #e9e9e9;
  }
</style>
