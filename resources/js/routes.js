import VueRouter from 'vue-router';

let routes = [

  {
    path: '/',
    component: require('./views/Home.vue')
  },

  {
    path: '/autre',
    component: require('./views/Autre.vue')
  },


]


export default new VueRouter({
  mode: 'history',
  routes
});
