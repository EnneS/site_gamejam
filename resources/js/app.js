import './bootstrap'
import router from './routes'
import store from './store'

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
    el: '#app',
    store,
    router
});
