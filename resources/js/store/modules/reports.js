const state = {

	reports: [],

};

const getters= {

	allReports: (state) => state.reports,

};

const actions= {

	async fetchReports ({ commit }, date) {

		const response = await axios.get(`/api/reports/getFromDate/${date.start}/${date.end}`);

		commit('setReports', response.data);

	},

};

const mutations= {

	setReports: (state, reports) => (state.reports = reports),

};


export default {

	state,

	getters,

	actions,

	mutations,

}
