<template>
  <header id="nav">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <router-link to="/" class="navbar-brand mr-5" style="font-weight:700" exact>GameJam</router-link>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavL" aria-controls="navbarNavL" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavL">
            <ul class="navbar-nav align-items-end">
              <li class="nav-item">
                <router-link to="/" class="nav-link" active-class="active" exact>Accueil</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/reglement" class="nav-link" active-class="active" exact>Règlement</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/bareme" class="nav-link" active-class="active" exact>Barême</router-link>
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
              <!--
              <li class="nav-item">
                <router-link to="/archives" class="nav-link" active-class="active" exact>Archives</router-link>
              </li>
              -->
              <li class="nav-item ml-5">
                <div v-if="getUser == null">
                  <a href="/api/cas.login" style="cursor:pointer" class="nav-link" >Se connecter</a>
                </div>
                <div v-else style="display:flex; position:relative">
                  <!-- notification bell -->
                  <div v-if="!isAdmin">
                    <span class="nav-link" style="margin-top:0.1em;cursor:pointer;" @click="notificationBox = !notificationBox">
                      <font-awesome-icon icon="bell" class="bell-icon"/>
                      <span class="badge badge-pill badge-danger notification-badge" v-if="getNotifications.length > 0">{{ getNotifications.length }}</span>
                    </span>
                    <div class="notification-box" v-if="notificationBox" v-on-clickaway="toggleNotificationBox">
                      <ul class="list-group">
                        <li class="list-group-item" v-for="notification in getNotifications">{{ notification }}</li>
                      </ul>
                    </div>
                  </div>

                  <!-- connected links -->
                  <router-link v-if="isAdmin" to="/admin/dashboard" tag="button" class="btn-gamejam btn-vert" active-class="active" exact>Admin</router-link>
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

  name: 'navDark',

  data(){
    return{
      notificationBox: false,
      notifications:[],
    }
  },

  mounted(){
  },

  computed:{
    getUser(){
      return this.$store.getters.user;
    },
    isAdmin(){
        return this.$store.getters.admin;
    },
    getNotifications(){
      let notifications = this.$store.getters.notifications;
      if(notifications) return notifications; else return [];
    }
  },

  methods:{
    async logout(){
      await this.$store.dispatch('logout').then(()=> {
        window.location.href = '/api/cas.logout';
      });
    },
    toggleNotificationBox(){
      this.notificationBox = false;
    }
  }
}
</script>

<style lang="css">
</style>
