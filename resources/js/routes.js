import VueRouter from 'vue-router';

let routes = [

  {
    path: '/',
    component: require('./views/Home.vue').default,
    name: 'Home'
  },

  {
    path: '/reglement',
    component: require('./views/Reglement.vue').default
  },

  {
    path: '/equipes',
    component: require('./views/Equipes.vue').default
  },

  {
    path: '/poules',
    component: require('./views/Poules.vue').default
  },

  {
    path: '/tutoriel',
    component: require('./views/Tutoriel.vue').default
  },

  {
    path: '/archives',
    component: require('./views/Archives.vue').default
  },

  {
    path: '/mon-equipe',
    component: require('./views/MonEquipe.vue').default,
    name: 'MonEquipe',
    meta: {requiresAuth: true}
  },

  {
    path: '/mon-equipe/creer',
    component: require('./views/EquipeCreer.vue').default,
    meta: {requiresAuth: true, requiresNoTeam: true}
  },

  {
    path: '/mon-equipe/edit',
    component: require('./views/EquipeEdit.vue').default,
    meta: {requiresAuth: true, requiresTeam: true}
  },

  // ADMIN
  {
    path: '/admin/login',
    component: require('./views/admin/Login.vue').default,
    name: 'AdminLogin',
    meta: {requiresGuest : true}
  },

  {
    path: '/admin/',
    component: require('./views/admin/Home.vue').default,
    children: [
      { path: '', name:'AdminHome', redirect: {name: 'AdminDashboard'}},
      { path: '/admin/dashboard', name:'AdminDashboard', component : require('./views/admin/Dashboard.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/etudiants', name:'AdminListeEtudiants', component : require('./views/admin/ListeEtudiants.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/equipes', name:'AdminListeEquipes', component : require('./views/admin/ListeEquipes.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/equipes/:id', name:'AdminEquipeDetail', component : require('./views/admin/EquipeDetail.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/poules', name:'AdminListePoules', component : require('./views/admin/ListePoules.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/reglement', name:'AdminReglement', component : require('./views/admin/Reglement.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/reglement/:id', name:'AdminReglementDetail', component : require('./views/admin/ReglementDetail.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/new/reglement', name:'AdminReglementCreer', component : require('./views/admin/ReglementCreer.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/tutoriel', name:'AdminTutoriel', component : require('./views/admin/Tutoriel.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/tutoriel/:id', name:'AdminTutorielDetail', component : require('./views/admin/TutorielDetail.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/new/tutoriel', name:'AdminTutorielCreer', component : require('./views/admin/TutorielCreer.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/admins', name:'AdminListeAdmins', component : require('./views/admin/ListeAdmins.vue').default, meta: {requiresAdmin : true}},
      { path: '/admin/new/admin', name:'AdminAdminCreer', component : require('./views/admin/AdminCreer.vue').default, meta: {requiresAdmin : true}},
    ]
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
