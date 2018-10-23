import VueRouter from 'vue-router';

let routes = [

  {
    path: '/',
    component: require('./views/Home.vue')
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


  // 404
  {
    path: '*',
    redirect: '/'
  },

]


export default new VueRouter({
  mode: 'history',
  routes
});
