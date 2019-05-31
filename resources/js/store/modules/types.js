const state = {

	types: [],

};

const getters= {
	
	allTypes: (state) => state.types,

};

const actions= {
	
	async fetchTypes ({ commit }) {

		const response = await axios.get(`/api/types`);
		
		commit('setTypes', response.data);

	},

};

const mutations= {
	
	setTypes: (state, types) => (state.types = types),

};


export default {

	state,

	getters,

	actions,

	mutations,

}