const state = {

	auth: {},

};

const getters= {
	
	authUser: (state) => state.auth,

	isLogin: (state) => {
		if(state.auth.token) {
			return true;
		}
		return false;
	}

};

const actions= {

	async login({ commit }, formData) {

		const response = await axios.post(`/api/login`, formData);

		commit('setUser', response.data);

		return response;
	},

	async logout({ commit }) {

		const response = await axios.post(`/api/logout`);

		commit('removeUser');

		return response;

	}

};

const mutations= {

	setUser: (state, user) => state.auth = user,

	removeUser: (state) => state.auth = {}

};


export default {

	state,

	getters,

	actions,

	mutations,

}