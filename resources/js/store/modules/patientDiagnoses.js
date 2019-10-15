const state = {

	patientDiagnoses: [],
	patientDiagnose: {},

};

const getters= {
	
	allPatientDiagnoses: (state) => state.patientDiagnoses,
	defaultPatientDiagnose: (state) => state.patientDiagnose,

};

const actions= {
	
	async fetchPatientDiagnoses({ commit }) {

		const response = await axios.get(`/api/patientDiagnoses`);
		
		commit('setPatientDiagnoses', response.data);

	},

	async fetchPatientDiagnosesByParentId({ commit }, patient_record) {

		const response = await axios.get(`/api/patientDiagnoses/${patient_record.id}/showByPatientId`);
		
		commit('setPatientDiagnoses', response.data);

		commit('setPatientDiagnoseRecord', patient_record);

	},

	async addPatientDiagnose( { commit }, formData ) {

		const response = await axios.post(`/api/patientDiagnoses`, formData);

		commit('newPatientDiagnose', response.data);

		return response;

	},

	async deletePatientDiagnose({ commit }, id) {

		const response = await axios.delete(`/api/patientDiagnoses/${id}`);

		commit('removePatientDiagnose', id);

		return response;

	},

	async updatePatientDiagnose( { commit }, patientDiagnose ) {

		const response = await axios.post(`/api/patientDiagnoses/${patientDiagnose.id}`, patientDiagnose.formData);

		commit('editPatientDiagnose', response.data);

		return response;

	},

	async showPatientDiagnoseById( { commit }, id) {

		const response = await axios.get(`/api/patientDiagnoses/${id}`);

		commit('viewPatientDiagnoseById', response.data);

		return response;

	}

};

const mutations= {
	
	setPatientDiagnoses: (state, patientDiagnoses) => (state.patientDiagnoses = patientDiagnoses),

	setPatientDiagnoseRecord: (state, patient_record) => (state.patientDiagnose.patient_record = patient_record),

	newPatientDiagnose: (state, patientDiagnose) => state.patientDiagnoses.unshift(patientDiagnose),

	removePatientDiagnose: (state, id) => state.patientDiagnoses = state.patientDiagnoses.filter(patientDiagnose => patientDiagnose.id !== id),

	viewPatientDiagnoseById: (state, data) => state.patientDiagnoses.filter(patientDiagnose => patientDiagnose.id === data.id),

	editPatientDiagnose: (state, updPatientDiagnose) => {
		const index = state.patientDiagnoses.findIndex(patientDiagnose => patientDiagnose.id === updPatientDiagnose.id);
		if(index !== -1) {
			state.patientDiagnoses.splice(index, 1, updPatientDiagnose);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}