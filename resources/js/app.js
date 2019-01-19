import './bootstrap'
import router from './routes'
import store from './store'
import App from './views/App.vue';

router.beforeEach(async (to, from, next) => {
    if (to.meta.requiresAuth) {
        if (!store.getters.check) { // Check if guest
          window.location.href ="/api/cas.login" // Force authentication
          return next({name: 'Home'});
        } else if(store.getters.admin) { // Check if admin
          return next({name: 'Home'});
        }
    }

    if (to.meta.requiresGuest) {
        if (store.getters.check) {
          return next({name: 'Home'});
        }
    }

    if (to.meta.requiresAdmin) {
        if (!store.getters.admin) {
          return next({name: 'AdminLogin'});
        }
    }

    if(to.meta.requiresNoTeam){
      if(store.getters.team){
        return next({name: 'MonEquipe'});
      }
    }

    if(to.meta.requiresTeam){
      if(!store.getters.team){
        return next({name: 'MonEquipe'});
      }
    }

    next();
});

new Vue({
    store,
    router,
    ...App,
});
