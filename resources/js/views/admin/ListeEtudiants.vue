<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <h3>Actions</h3>
        <div class="card">
          <div class="card-body">
            <button type="button" name="button" class="btn btn-success w-100" data-toggle="modal" data-target="#confirmationModal">Récupérer les étudiants</button>
            <hr>
            <button type="button" name="button" class="btn btn-success w-100" @click="goToStudentCreate">Ajouter un étudiant</button>
          </div>
        </div>
      </div>
      <div class="col-sm">
        <h3>
          Liste des étudiants
          <span class="ml-2 badge badge-primary badge-pill" style="font-size:0.5em">{{students.length}} étudiants</span>
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
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Non">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Récupérer les étudiants entrainera la suppression de ceux déjà existants et de leurs équipes respectives.<br>
            Etes-vous sûr?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-success" @click="generateStudents">Oui, récupérer les étudiants</button>
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
    goToStudentCreate(){
      this.$router.push('/admin/new/etudiant')
    },
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
      $('#confirmationModal').modal("hide");
      this.$toasted.info("Récupération des étudiants...", {duration : 2000});

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
