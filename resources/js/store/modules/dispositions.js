const state = {

	dispositions: [],

};

const getters= {
	
	allDispositions: (state) => state.dispositions,

};

const actions= {
	
	async fetchDispositions ({ commit }) {

		const response = await axios.get(`/api/dispositions`);
		
		commit('setDispositions', response.data);

	},

};

const mutations= {
	
	setDispositions: (state, dispositions) => (state.dispositions = dispositions),

};


export default {

	state,

	getters,

	actions,

	mutations,

}