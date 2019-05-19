const state = {

	roles: [],

};

const getters= {
	
	allRoles: (state) => state.roles,

	rolesInSelectorFormat: (state) => state.roles.map( (role) => ({
		value: role.id,
		label: role.name,
	}))

};

const actions= {
	
	async fetchRoles ({ commit }) {

		const response = await axios.get(`/api/roles`);
		
		commit('setRoles', response.data);

	},

};

const mutations= {
	
	setRoles: (state, roles) => (state.roles = roles),

};


export default {

	state,

	getters,

	actions,

	mutations,

}