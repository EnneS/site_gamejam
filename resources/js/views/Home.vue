<template>
  <main style="margin-right:-15px;margin-left:-15px;">
    <!-- Nav -->

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
          <h1 class="display-4 mb-4 mt-5">GameJam {{ getYear }}</h1>
          <p class="h5 mb-4 w-75">
            Bienvenue sur le site de la GameJam {{ getYear }} !<br/>
            La GameJam est une semaine organisée par l'IUT2 où tous les étudiants du semestre S3 et S2D s'affronteront dans une lutte acharnée dans le but de créér un jeu vidéo avec un langage de programmation et un thème donné.<br/>
            <span style="font-weight:700">Constituez vos équipes et remportez la victoire.</span>
          </p>
          <router-link to="/mon-equipe/creer" tag="button" class="btn-gamejam btn-vert btn-up mr-4 mb-2" exact>créer votre équipe</router-link>
          <router-link to="/equipes" tag="button" class="btn-gamejam btn-up" exact>rejoindre une équipe</router-link>
        </div>
      </section>
    </header>

    <!-- Hall Of Fame -->
    <section class="mb-5" id="hall-of-fame">
      <div class="row">
        <div class="container justify-content-center">
          <h1>Hall of Fame</h1>
          <div v-for="year in years" v-if="year.games.length > 1">
            <h4 class="mt-5 mb-3">{{ year.year }}</h4>
            <div class="row d-flex justify-content-between">
              <div class="col" v-for="game in year.games">
                <img :src="'storage/games/' + game.hash + '/jaquette.png'" alt="" class="game-jaquette">
                <p>{{ game.name }}</p>
              </div>
            </div>
          </div>
          <div v-else class="alert alert-info">
            Aucun jeu ne figure dans le Hall Of Fame pour l'instant !
            <p class="m-0">Donnez le meilleur de vous pour que votre jeu figure ici.</p>
          </div>
        </div>
      </div>
    </section>

  </main>
</template>

<script>

export default {

  data(){
    return{
      years : [],
    }
  },

  computed:{
    getYear(){
      let date = new Date();
      return date.getFullYear();
    }
  },

  mounted() {
    axios.get('/api/halloffame')
    .then((response) => {
      this.years = response.data;
    });
  }
}
</script>

<style lang="css">
</style>
