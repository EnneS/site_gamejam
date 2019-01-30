<template>
  <div class="container">
    <h3>
      Liste des étudiants
      <span class="ml-2 badge badge-primary badge-pill" style="font-size:0.5em">{{students.length}} étudiants</span>
      <button type="button" name="button" class="btn btn-success float-right" @click="generateStudents">Récupérer les étudiants</button>
    </h3>
    <div class="admin-box">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Equipe</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students">
            <td scope="row">{{ student.first_name }}</td>
            <td>{{ student.last_name }}</td>
            <td>
              <span v-if="student.team_id">{{ student.team_id }}</span>
              <span v-else class="badge badge-pill badge-danger">Aucune équipe</span>
            </td>
            <td>
              <button type="button" name="button" class="btn btn-danger btn-sm float-right" @click="deleteStudent(student.id)">Supprimer l'élève</button>
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
    deleteStudent(id){
      axios.post('/api/admin.student.delete', {id : id})
      .then((response) => {
        // Delete the student in the array
        let i = 0;
        while(i < this.students.length && this.students[i].id != id){
          i++;
        }
        this.students.splice(i, 1);
        this.$toasted.success(response.data.message, {duration : 2000});
      });
    },
    generateStudents(){
      axios.get('/api/admin.students.generate')
      .then((response) => {
        this.students = response.data.students;
        this.$toasted.success(response.data.message, {duration : 2000});
      })
      .catch((error) => {
        this.$toasted.error(error.response.data.message, {duration : 2000});
      })
    }
  }
}
</script>

<style lang="css">
</style>
