const state = {

	diagnoses: [],

};

const getters= {
	
	allDiagnoses: (state) => state.diagnoses,

};

const actions= {
	
	async fetchDiagnoses({ commit }) {

		const response = await axios.get(`/api/diagnoses`);
		
		commit('setDiagnoses', response.data);

	},

	async addDiagnose( { commit }, formData ) {

		const response = await axios.post(`/api/diagnoses`, formData);

		commit('newDiagnose', response.data);

		return response;

	},

	async deleteDiagnose({ commit }, id) {

		const response = await axios.delete(`/api/diagnoses/${id}`);

		commit('removeDiagnose', id);

		return response;

	},

	async updateDiagnose( { commit }, diagnose ) {

		const response = await axios.post(`/api/diagnoses/${diagnose.id}`, diagnose.formData);

		commit('editDiagnose', response.data);

		return response;

	},

	async showDiagnoseById( { commit }, id) {

		const response = await axios.get(`/api/diagnoses/${id}`);
		console.log(response.data);
		commit('viewDiagnoseById', response.data);

		return response;

	}

};

const mutations= {
	
	setDiagnoses: (state, diagnoses) => (state.diagnoses = diagnoses),

	newDiagnose: (state, diagnose) => state.diagnoses.unshift(diagnose),

	removeDiagnose: (state, id) => state.diagnoses = state.diagnoses.filter(diagnose => diagnose.id !== id),

	viewDiagnoseById: (state, data) => state.diagnoses.filter(diagnose => diagnose.id === data.id),

	editDiagnose: (state, updDiagnose) => {
		const index = state.diagnoses.findIndex(diagnose => diagnose.id === updDiagnose.id);
		if(index !== -1) {
			state.diagnoses.splice(index, 1, updDiagnose);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}