import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Cookies from 'js-cookie'

let state = {
  user : null
}

export default new Vuex.Store({
  state,
  mutations:{
    setUser (state, user) {
      state.user = user;
    },
  },
  plugins: [
      createPersistedState({
          getState: (key) => Cookies.getJSON(key),
          setState: (key, state) => Cookies.set(key, state, { expires: 3, secure: false })
      })
  ]
});
