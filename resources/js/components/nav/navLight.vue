<template>
  <header id="navHome">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark justify-content-between">
          <router-link to="/" class="navbar-brand mr-5" style="font-weight:700" exact>GameJam</router-link>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-end">
              <li class="nav-item">
                <router-link to="/" class="nav-link" active-class="active" exact>Accueil</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/reglement" class="nav-link" active-class="active" exact>Règlement</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/equipes" class="nav-link" active-class="active" exact>Équipes</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/poules" class="nav-link" active-class="active" exact>Poules</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/tutoriel" class="nav-link" active-class="active" exact>Tutoriel</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/archives" class="nav-link" active-class="active" exact>Archives</router-link>
              </li>
              <li class="nav-item ml-5">
                <div v-if="getUser == null">
                  <a href="/api/cas.login" style="cursor:pointer" class="nav-link" >Se connecter</a>
                </div>
	              <div v-else style="display:flex; position:relative">
                  <!-- notification bell -->
                  <span class="nav-link" style="margin-top:0.1em;cursor:pointer;" @click="notificationBox = !notificationBox">
                    <font-awesome-icon icon="bell" class="bell-icon"/>
                    <span class="badge badge-pill badge-primary notification-badge" v-if="getNotifications.length > 0">{{ getNotifications.length }}</span>
                  </span>
                  <div class="notification-box" v-if="notificationBox" v-on-clickaway="toggleNotificationBox">
                    <ul class="list-group">
                      <li class="list-group-item" v-for="notification in getNotifications">{{ notification }}</li>
                    </ul>
                  </div>

                  <!-- connected links -->
                  <router-link v-if="isAdmin" to="/admin/dashboard" tag="button" class="btn-gamejam" active-class="active" exact>Admin</router-link>
                  <router-link v-else to="/mon-equipe" class="nav-link" active-class="active" exact>Mon équipe</router-link>
                  <span style="cursor:pointer" v-on:click="logout()" class="nav-link">Se déconnecter</span>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
  </header>
</template>

<script>
import { mixin as clickaway } from 'vue-clickaway';

export default {
  mixins: [ clickaway ],

  name: 'navLight',

  data(){
    return{
      notificationBox : false,
      notifications:[],
    }
  },

  computed:{
    getUser(){
      return this.$store.state.user;
    },
    isAdmin(){
        return this.$store.getters.admin;
    },
    getNotifications(){
      return this.$store.state.notifications;
    }
  },

  methods:{
    logout(){
      window.location.href = '/api/cas.logout';
      this.$store.commit('setUser', null);
    },
    toggleNotificationBox(){
      this.notificationBox = false;
    }
  }
}
</script>

<style lang="css">
</style>
