const state = {

	patientRecords: [],

};

const getters= {
	
	allPatientRecords: (state) => state.patientRecords,

};

const actions= {
	
	async fetchPatientRecords({ commit }) {

		const response = await axios.get(`/api/patientRecords`);
		
		commit('setPatientRecords', response.data);

	},

	async addPatientRecord( { commit }, formData ) {

		const response = await axios.post(`/api/patientRecords`, formData);

		commit('newPatientRecord', response.data);

		return response;

	},

	async deletePatientRecord({ commit }, id) {

		const response = await axios.delete(`/api/patientRecords/${id}`);

		commit('removePatientRecord', id);

		return response;

	},

	async updatePatientRecord( { commit }, patientRecord ) {

		const response = await axios.post(`/api/patientRecords/${patientRecord.id}`, patientRecord.formData);

		commit('editPatientRecord', response.data);

		return response;

	},

	async showPatientRecordById( { commit }, id) {

		const response = await axios.get(`/api/patientRecords/${id}`);

		commit('viewPatientRecordById', response.data);

		return response;

	}

};

const mutations= {
	
	setPatientRecords: (state, patientRecords) => (state.patientRecords = patientRecords),

	newPatientRecord: (state, patientRecord) => state.patientRecords.unshift(patientRecord),

	removePatientRecord: (state, id) => state.patientRecords = state.patientRecords.filter(patientRecord => patientRecord.id !== id),

	viewPatientRecordById: (state, data) => state.patientRecords.filter(patientRecord => patientRecord.id === data.id),

	editPatientRecord: (state, updPatientRecord) => {
		const index = state.patientRecords.findIndex(patientRecord => patientRecord.id === updPatientRecord.id);
		if(index !== -1) {
			state.patientRecords.splice(index, 1, updPatientRecord);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}