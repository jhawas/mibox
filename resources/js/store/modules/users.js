const state = {

	users: [],

};

const getters= {
	
	allUsers: (state) => state.users,

};

const actions= {

	async fetchUsers({ commit }) {

		const response = await axios.get(`/api/users`);
		
		commit('setUsers', response.data);

	},

	async addUser( { commit }, formData ) {

		const response = await axios.post(`/api/users`, formData);

		commit('newUser', response.data);

		return response;

	},

	async deleteUser({ commit }, id) {

		const response = await axios.delete(`/api/users/${id}`);

		commit('removeUser', id);

		return response;

	},

	async updateUser( { commit }, user ) {

		const response = await axios.post(`/api/users/${user.id}`, user.formData);

		commit('editUser', response.data);

		return response;

	},

	async showUserById( { commit }, id) {

		const response = await axios.get(`/api/users/${id}`);

		commit('viewUserById', response.data);

		return response;

	}
};

const mutations= {

	setUsers: (state, users) => (state.users = users),

	newUser: (state, user) => state.users.unshift(user),

	removeUser: (state, id) => state.users = state.users.filter(user => user.id !== id),

	viewUserById: (state, data) => state.users.filter(user => user.id === data.id),

	editUser: (state, updUser) => {
		const index = state.users.findIndex(user => user.id === updUser.id);
		if(index !== -1) {
			state.users.splice(index, 1, updUser);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}