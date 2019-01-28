// Router Module
import VueRouter from 'vue-router';

// =========
// Guest Views
import Home from './views/Home';
import Reglement from './views/Reglement';
import Equipes from './views/Equipes';
import Poules from './views/Poules';
import Tutoriel from './views/Tutoriel';
import Archives from './views/Archives';

// ========
// Student Views
import MonEquipe from './views/MonEquipe';
import EquipeCreer from './views/EquipeCreer';
import EquipeEdit from './views/EquipeEdit';

// ========
// Admin Views
import AdminLogin from './views/admin/Login';
import AdminHome from './views/admin/Home';
import AdminDashboard from './views/admin/Dashboard';
import AdminListeEtudiants from './views/admin/ListeEtudiants';
import AdminListeEquipes from './views/admin/ListeEquipes';
import AdminEquipeDetail from './views/admin/EquipeDetail';
import AdminListePoules from './views/admin/ListePoules';
import AdminReglement from './views/admin/Reglement';
import AdminReglementDetail from './views/admin/ReglementDetail';
import AdminReglementCreer from './views/admin/ReglementCreer';
import AdminTutoriel from './views/admin/Tutoriel';
import AdminTutorielDetail from './views/admin/TutorielDetail';
import AdminTutorielCreer from './views/admin/TutorielCreer';
import AdminListeAdmins from './views/admin/ListeAdmins';
import AdminAdminCreer from './views/admin/AdminCreer';

let routes = [

  {
    path: '/',
    component: Home,
    name: 'Home'
  },

  {
    path: '/reglement',
    component: Reglement
  },

  {
    path: '/equipes',
    component: Equipes
  },

  {
    path: '/poules',
    component: Poules
  },

  {
    path: '/tutoriel',
    component: Tutoriel
  },

  {
    path: '/archives',
    component: Archives
  },

  {
    path: '/mon-equipe',
    component: MonEquipe,
    name: 'MonEquipe',
    meta: {requiresAuth: true}
  },

  {
    path: '/mon-equipe/creer',
    component: EquipeCreer,
    meta: {requiresAuth: true, requiresNoTeam: true}
  },

  {
    path: '/mon-equipe/edit',
    component: EquipeEdit,
    meta: {requiresAuth: true, requiresTeam: true}
  },

  // ADMIN
  {
    path: '/admin/login',
    component: AdminLogin,
    name: 'AdminLogin',
    meta: {requiresGuest : true}
  },

  {
    path: '/admin/',
    component: require('./views/admin/Home.vue').default,
    children: [
      { path: '', name:'AdminHome', redirect: {name: 'AdminDashboard'}},
      { path: '/admin/dashboard', name:'AdminDashboard', component : AdminDashboard, meta: {requiresAdmin : true}},
      { path: '/admin/etudiants', name:'AdminListeEtudiants', component : AdminListeEtudiants, meta: {requiresAdmin : true}},
      { path: '/admin/equipes', name:'AdminListeEquipes', component : AdminListeEquipes, meta: {requiresAdmin : true}},
      { path: '/admin/equipes/:id', name:'AdminEquipeDetail', component : AdminEquipeDetail, meta: {requiresAdmin : true}},
      { path: '/admin/poules', name:'AdminListePoules', component : AdminListePoules, meta: {requiresAdmin : true}},
      { path: '/admin/reglement', name:'AdminReglement', component : AdminReglement, meta: {requiresAdmin : true}},
      { path: '/admin/reglement/:id', name:'AdminReglementDetail', component : AdminReglementDetail, meta: {requiresAdmin : true}},
      { path: '/admin/new/reglement', name:'AdminReglementCreer', component : AdminReglementCreer, meta: {requiresAdmin : true}},
      { path: '/admin/tutoriel', name:'AdminTutoriel', component : AdminTutoriel, meta: {requiresAdmin : true}},
      { path: '/admin/tutoriel/:id', name:'AdminTutorielDetail', component : AdminTutorielDetail, meta: {requiresAdmin : true}},
      { path: '/admin/new/tutoriel', name:'AdminTutorielCreer', component : AdminTutorielCreer, meta: {requiresAdmin : true}},
      { path: '/admin/admins', name:'AdminListeAdmins', component : AdminListeAdmins, meta: {requiresAdmin : true}},
      { path: '/admin/new/admin', name:'AdminAdminCreer', component : AdminAdminCreer, meta: {requiresAdmin : true}},
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
