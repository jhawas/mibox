const state = {

	patients: [],

};

const getters= {
	
	allPatients: (state) => state.patients,

};

const actions= {
	
	async fetchPatients({ commit }) {

		const response = await axios.get(`/api/patients`);
		
		commit('setPatients', response.data);

	},

	async addPatient( { commit }, formData ) {

		const response = await axios.post(`/api/patients`, formData);

		commit('newPatient', response.data);

		return response;

	},

	async deletePatient({ commit }, id) {

		const response = await axios.delete(`/api/patients/${id}`);

		commit('removePatient', id);

		return response;

	},

	async updatePatient( { commit }, patient ) {

		const response = await axios.post(`/api/patients/${patient.id}`, patient.formData);

		commit('viewPatient', response.patients);

		return response;

	},

	async showPatientById( { commit }, id) {

		const response = await axios.get(`/api/patients/${id}`);

		commit('viewPatientById', response.data);

		return response;

	}

};

const mutations= {
	
	setPatients: (state, patients) => (state.patients = patients),

	newPatient: (state, patient) => state.patients.unshift(patient),

	removePatient: (state, id) => state.patients = state.patients.filter(patient => patient.id !== id),

	viewPatientById: (state, data) => state.patients.filter(patient => patient.id === data.id),

	editPatient: (state, updPatient) => {
		const index = state.patients.findIndex(patient => patient.id === updPatient.id);
		if(index !== -1) {
			state.patients.splice(index, 1, updPatient);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}