<template lang="html">
  <header id="nav">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link" href="#">Se connecter</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
  </header>
</template>

<script>
export default {
  name: 'navDark'
}
</script>

<style lang="css">
</style>
