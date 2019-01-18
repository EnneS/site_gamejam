<template lang="html">
  <div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3 class="mb-0">Panel Admin</h3>
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
        route: 'AdminStudentsList',
      }],
    }
  },

  mounted() {
  },

  methods: {
    isTabActive(route){
      return route == this.$router.currentRoute.name;
    }
  }
}
</script>

<style lang="css">
</style>
