<template>
  <div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3 >Panel Admin</h3>
            <h4 class="mb-0" style="font-weight:700"><span class="badge badge-pill badge-light">{{ name }}</span></h4>
        </div>
        <ul class="list-unstyled components">

            <!--<li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Home 1</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
          -->
            <li v-for="(tab, index) in tabs" :class="{active : isTabActive(tab.route)}">
              <router-link :to="{ name: tab.route }">
                {{ tab.name }}
              </router-link>
            </li>

            <li class="footer-nav">
              <a @click.prevent="$router.push('/')">Retourner sur le site</a>
              <a @click="logout">Déconnexion</a>
            </li>
        </ul>

    </nav>

    <!-- Page Content -->
    <div id="content" class="pt-5">
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>
    </div>

  </div>
</template>

<script>
export default {

  data(){
    return {
      tabs : [{
        name: 'Accueil',
        route: 'AdminDashboard',
      },
      {
        name: 'Etudiants',
        route: 'AdminListeEtudiants',
      },
      {
        name: 'Equipes',
        route: 'AdminListeEquipes',
      },
      {
        name: 'Poules',
        route: 'AdminListePoules',
      },
      {
        name: 'Règlement',
        route: 'AdminReglement',
      },
      {
        name: 'Tutoriel',
        route: 'AdminTutoriel',
      },
      {
        name: 'Administrateurs',
        route: 'AdminListeAdmins',
      }],
    }
  },

  mounted() {
  },

  computed:{
    name(){
      if(this.$store.getters.admin){
        return this.$store.getters.user['first_name'] + ' ' + this.$store.getters.user['last_name'];
      } else {
        this.$router.push('/');
      }
    }
  },

  methods: {
    isTabActive(route){
      return route == this.$router.currentRoute.name;
    },
    async logout(){
      await this.$store.dispatch('logout').then(()=> {
        window.location.href = '/api/cas.logout';
      });
    }

  }
}
</script>

<style lang="css">
  .footer-nav{
    position: absolute;
    width:250px;
    bottom:0px;
    cursor:pointer;
  }
</style>
