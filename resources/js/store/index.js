import Vuex from 'vuex';
import Vue from 'vue';

import auth from './modules/auth';
import roles from './modules/roles';
import patients from './modules/patients';
import users from './modules/users';
import typeOfRooms from './modules/typeOfRooms';
import floors from './modules/floors';
import rooms from './modules/rooms';

Vue.use(Vuex);

export default new Vuex.Store({
  	modules: {
  		auth,
  		users,
  		patients,
  		roles,
  		typeOfRooms,
  		floors,
  		rooms,
  	},
});

