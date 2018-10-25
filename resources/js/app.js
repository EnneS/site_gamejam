import './bootstrap'
import router from './routes'
import store from './store'
import App from './views/App.vue';

router.beforeEach(async (to, from, next) => {
    if (to.meta.requiresAuth) {
        if (store.getters.check)
            return next();
        else
            return next({name: 'Home'});
    }

    if(to.meta.requiresNoTeam){
      if(!store.getters.team){
        return next();
      } else {
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
