import VueRouter from 'vue-router';

let routes = [

  {
    path: '/',
    component: require('./views/Home.vue'),
    name: 'Home'
  },

  {
    path: '/reglement',
    component: require('./views/Reglement.vue')
  },

  {
    path: '/equipes',
    component: require('./views/Equipes.vue')
  },

  {
    path: '/poules',
    component: require('./views/Poules.vue')
  },

  {
    path: '/tutoriel',
    component: require('./views/Tutoriel.vue')
  },

  {
    path: '/archives',
    component: require('./views/Archives.vue')
  },

  {
    path: '/mon-equipe',
    component: require('./views/MonEquipe.vue'),
    name: 'MonEquipe',
    meta: {requiresAuth: true}
  },

  {
    path: '/mon-equipe/creer',
    component: require('./views/EquipeCreer.vue'),
    meta: {requiresAuth: true, requiresNoTeam: true}
  },

  {
    path: '/mon-equipe/edit',
    component: require('./views/EquipeEdit.vue'),
    meta: {requiresAuth: true, requiresTeam: true}
  },


  // 404
  {
    path: '*',
    redirect: '/'
  },

]


const router = new VueRouter({
  mode: 'history',
  routes
});


export default router;
