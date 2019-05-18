import { getLocalUser } from "../../helpers/auth";
import { setAuthorization } from "../../helpers/default";

const user = getLocalUser();

const state = {

	currentUser: user,

	isLoggedIn: !!user,

};

const getters= {
	
	isLoggedIn(state) {

		return state.isLoggedIn;
	
	},

	currentUser(state) {

		return state.currentUser;

	},

};

const actions= {

	async login({ commit }, formData) {

		const response = await axios.post(`/api/login`, formData);

		commit('login', response.data);

		return response;
	},

	async logout({ commit }) {

		const response = await axios.post(`/api/logout`);

		return response;

	}

};

const mutations= {

	login(state, payload) {
		
		state.isLoggedIn = true;

		state.currentUser = Object.assign({}, payload.user, { token: payload.token });

		localStorage.setItem("user", JSON.stringify(state.currentUser));

		setAuthorization(payload.token);

	},

	logout(state) {

		localStorage.removeItem("user");

		state.isLoggedIn = false;

		state.currentUser = null;

	}

};


export default {

	state,

	getters,

	actions,

	mutations,

}