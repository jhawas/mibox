import Vuex from 'vuex';
import Vue from 'vue';
import createPersistedState from 'vuex-persistedstate';
import * as Cookies from 'js-cookie';

import auth from './modules/auth';
import patients from './modules/patients';

Vue.use(Vuex);

export default new Vuex.Store({
  	modules: {
  		auth,
  		patients
  	},
  	plugins: [createPersistedState({
	      	storage: {
		      	getItem: key => Cookies.get(key),
		      	setItem: (key, value) => Cookies.set(key, value, { expires: 3, secure: true }),
		      	removeItem: key => Cookies.remove(key)
		    }
	    })
  	]
});

