import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Cookies from 'js-cookie'

let state = {
  user : null,
  notifications: [],
}

// getters
const getters = {
  user : state => state.user,
  notifications : state => state.notifications,
  check: state => state.user !== null,
  team: state => state.user !== null && state.user.team_id !== null,
  team_id: state => state.user.team_id,
  admin: state => state.user !== null && state.user.admin === 1,
}

export default new Vuex.Store({
  state, getters,
  mutations:{
    logout(state){
      state.user = null;
      state.notifications = null;
    },
    setUser (state, user) {
      state.user = user;
    },
    setTeam(state, team) {
      state.user.team_id = team;
    },
    addJoinRequest(state, joinRequest){
      state.user.join_requests.splice(1, 0, joinRequest);
    },
    deleteJoinRequests(state){
      state.user.join_requests = [];
    },
    setNotifications(state, notifications){
      state.notifications = notifications;
    }
  },
  actions: {
    logout ({ commit }) {
      return new Promise((resolve, reject) => {
          commit('logout')
          resolve()
      });
    }
  },
  plugins: [
      createPersistedState({
          getState: (key) => Cookies.getJSON(key),
          setState: (key, state) => Cookies.set(key, state, { expires: 999, secure: false })
      })
  ]
});
