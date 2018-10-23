<template lang="html">
  <main>
    <!-- Nav -->
    <navLight/>

    <!-- Stripes -->
    <header id="stripes-header">
      <div id="stripes">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>

      <!-- Header text -->
      <section id="intro">
        <div class="container intro-container text-white">
          <h1 class="display-4 mb-4">GameJam 2019</h1>
          <p class="h5 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <router-link to="/" tag="button" class="btn-gamejam btn-vert mr-4" exact>créer votre équipe</router-link>
          <router-link to="/equipes" tag="button" class="btn-gamejam" exact>rejoindre une équipe</router-link>
        </div>
      </section>
    </header>

    <!-- Hall Of Fame -->
    <section class="mb-5" id="hall-of-fame">
      <div class="row">
        <div class="container justify-content-center">
          <h1>Hall of Fame</h1>
          <div>
            <h4 class="mt-5 mb-3">Année</h4>
            <div class="row d-flex justify-content-between">
              <div class="col">
                <img src="https://via.placeholder.com/300.png/09f/fff" alt="">
                <p>Nom du jeu</p>
              </div>
              <div class="col">
                <img src="https://via.placeholder.com/300.png/09f/fff" alt="">
                <p>Nom du jeu</p>
              </div>
              <div class="col">
                <img src="https://via.placeholder.com/300.png/09f/fff" alt="">
                <p>Nom du jeu</p>
              </div>
            </div>
          </div>

          <div>
            <h4 class="mt-5 mb-3">Année</h4>
            <div class="row d-flex justify-content-between">
              <div class="col">
                <img src="https://via.placeholder.com/300.png/09f/fff" alt="">
                <p>Nom du jeu</p>
              </div>
              <div class="col">
                <img src="https://via.placeholder.com/300.png/09f/fff" alt="">
                <p>Nom du jeu</p>
              </div>
              <div class="col">
                <img src="https://via.placeholder.com/300.png/09f/fff" alt="">
                <p>Nom du jeu</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
</template>

<script>
import navLight from '../components/nav/navLight.vue'

export default {
  components: {navLight},

  mounted() {
  }
}
</script>

<style lang="css">
</style>
