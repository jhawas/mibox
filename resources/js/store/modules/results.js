const state = {

	results: [],

};

const getters= {
	
	allResults: (state) => state.results,

};

const actions= {
	
	async fetchResults ({ commit }) {

		const response = await axios.get(`/api/results`);
		
		commit('setResults', response.data);

	},

};

const mutations= {
	
	setResults: (state, results) => (state.results = results),

};


export default {

	state,

	getters,

	actions,

	mutations,

}