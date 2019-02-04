<template>
  <div class="container">
    <h3>Dashboard</h3>
    <div class="row mb-4">
      <div class="col-sm-4">
        <h5>Configuration</h5>
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="submitConfiguration()">
              <div class="form-group">
                <label for="studentperteam">Nombre maximum d'étudiants par équipe</label>
                <input type="number" v-model="configuration.studentsPerTeam" class="form-control" id="studentperteam" placeholder="Nombre maximum d'étudiants par équipe...">
              </div>
              <div class="form-group">
                <label for="maxteamcount">Nombre maximum d'équipes</label>
                <input type="number" v-model="configuration.maxTeamCount" class="form-control" id="maxteamcount" placeholder="Nombre maximum d'équipes...">
              </div>
              <button type="submit" class="btn btn-success" name="button">Sauvegarder</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <h5>Notifications</h5>
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="sendNotification">
              <div class="input-group">
                <input type="text" v-model="notificationText" class="form-control input-notification" placeholder="Entrer un message...">
                <div class="input-group-append">
                  <button class="btn btn-success button-notification" type="submit">Envoyer la notification</button>
                </div>
              </div>
            </form>
            <ul class="list-group list-notifications text-dark" v-if="notifications.length > 0">
              <li class="list-group-item d-flex justify-content-between align-items-center" v-for="notification in this.notifications">
                <span>{{ notification.body }}</span>
                <span>
                  <font-awesome-icon icon="times" class="text-danger" @click="deleteNotification(notification.id)" style="cursor:pointer;"/>
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <h5>Barême</h5>
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="uploadBareme()">
              <label for="file-upload">Fichier PDF du barême</label>
              <div class="custom-file mb-2" id="file-upload">
                <input v-on:change="handleFileUpload"  ref='pdf' type="file" class="custom-file-input" id="inputGroupFile04" required>
                <label class="custom-file-label" for="inputGroupFile04" style="line-height:2;">{{ pdf.name }}</label>
              </div>
              <button type="submit" class="btn btn-success" name="button">Envoyer</button>
            </form>
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
      configuration:{
        studentsPerTeam : 0,
        maxTeamCount : 0,
      },
      pdf: {
        name: 'Sélectionner un fichier...',
        file : null,
      },
      notifications:[],
      notificationText : '',
    }
  },

  mounted() {
    this.getConfiguration();
    this.getNotifications();
  },

  methods:{
    // Notifications methods
    getNotifications(){
      axios.get('/api/admin.notifications')
      .then((response) => {
        this.notifications = response.data;
      });
    },
    sendNotification(){
      axios.post('/api/admin.notification.create', {text : this.notificationText})
      .then((response) => {
        this.notifications.push(response.data.notification);
        this.$toasted.success(response.data.message, {duration : 2000});
      });
    },
    deleteNotification(id){
      axios.post('/api/admin.notification.delete', {id : id})
      .then((response) => {
        // Delete from array
        let i = 0;
        while(i < this.notifications.length && this.notifications[i].id != id){
          i++;
        }
        this.notifications.splice(i, 1);
        this.$toasted.success(response.data.message, {duration : 2000});
      });
    },
    
    // Configuration methods
    getConfiguration(){
      axios.get('/api/admin.configuration')
      .then((response) => {
        this.configuration.studentsPerTeam = response.data.studentsPerTeam;
        this.configuration.maxTeamCount = response.data.maxTeamCount;
      });
    },
    submitConfiguration(){
      axios.post('/api/admin.configuration.update', this.configuration)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
      })
    },

    // Bareme upload methods
    handleFileUpload(){
      this.pdf.file = this.$refs['pdf'].files[0];
      this.pdf.name = this.$refs['pdf'].files[0].name;
    },
    uploadBareme(){
      let formData = new FormData();
      formData.append('bareme', this.pdf.file);

      axios.post('/api/admin.uploadBareme', formData)
      .then((response) => {
        this.$toasted.success(response.data.message, {duration : 2000});
        this.pdf.file = null;
        this.pdf.name = "Sélectionner un fichier...";
      })
      .catch((error) => {
        this.$toasted.error(error.response.data.errors.bareme[0], {duration : 2000});
      });
    }
  }
}
</script>

<style lang="css">
.list-notifications .list-group-item:first-child {
  border-top-right-radius: 0px !important;
  border-top-left-radius: 0px !important;
  border-top:0;
}
.button-notification {
  border-bottom-right-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
}
.input-notification {
  border-bottom-left-radius: 0px !important;
}
</style>
