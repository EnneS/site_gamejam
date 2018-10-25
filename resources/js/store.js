import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Cookies from 'js-cookie'

let state = {
  user : null,
}

// getters
const getters = {
  check: state => state.user !== null,
  team: state => state.user.team_id !== null,
  team_id: state => state.user.team_id,
}

export default new Vuex.Store({
  state, getters,
  mutations:{
    setUser (state, user) {
      state.user = user;
    },
    setTeam(state, team) {
      state.user.team_id = team;
    }
  },
  plugins: [
      createPersistedState({
          getState: (key) => Cookies.getJSON(key),
          setState: (key, state) => Cookies.set(key, state, { expires: 3, secure: false })
      })
  ]
});
