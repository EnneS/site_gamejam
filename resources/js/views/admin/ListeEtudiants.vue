<template>
  <div class="container">
    <h3>Liste des étudiants</h3>

    <div class="admin-box">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Equipe</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students">
            <th scope="row">{{ student.id }}</th>
            <td>{{ student.first_name }}</td>
            <td>{{ student.last_name }}</td>
            <td>
              <span v-if="student.team_id">{{ student.team_id }}</span>
              <span v-else class="badge badge-pill badge-danger">Aucune équipe</span>
            </td>
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
      students : []
    }
  },

  mounted() {
    axios.get('/api/admin.students')
    .then((response) => {
      this.students = response.data;
    });
  },

  methods:{
  }
}
</script>

<style lang="css">
</style>
