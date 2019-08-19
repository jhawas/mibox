const state = {

	dashboard: [],

};

const getters= {
	
	allDashboard: (state) => state.dashboard,

};

const actions= {
	
	async fetchDashboard ({ commit }) {

		const response = await axios.get(`/api/dashboard`);
		
		commit('setDashboard', response.data);

	},

};

const mutations= {
	
	setDashboard: (state, dashboard) => (state.dashboard = dashboard),

};


export default {

	state,

	getters,

	actions,

	mutations,

}