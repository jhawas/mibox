import Vuex from 'vuex';
import Vue from 'vue';

import auth from './modules/auth';
import roles from './modules/roles';
import patients from './modules/patients';
import users from './modules/users';

Vue.use(Vuex);

export default new Vuex.Store({
  	modules: {
  		auth,
  		users,
  		patients,
  		roles
  	},
});

