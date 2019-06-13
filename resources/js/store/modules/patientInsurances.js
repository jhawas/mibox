const state = {

	patientInsurances: [],

};

const getters= {
	
	allPatientInsurances: (state) => state.patientInsurances,

};

const actions= {
	
	async fetchPatientInsurances({ commit }) {

		const response = await axios.get(`/api/patientInsurances`);
		
		commit('setPatientInsurances', response.data);

	},

	async fetchInsurancesByRecord({ commit }, patient_record) {

		const response = await axios.get(`/api/patientInsurances/patientRecord/${patient_record.id}`);
		
		commit('setPatientInsurances', response.data);

	},

	async addPatientInsurance( { commit }, formData ) {

		const response = await axios.post(`/api/patientInsurances`, formData);

		commit('newPatientInsurance', response.data.patientInsurance);

		return response;

	},

	async deletePatientInsurance({ commit }, id) {

		const response = await axios.delete(`/api/patientInsurances/${id}`);

		commit('removePatientInsurance', id);

		return response;

	},

	async updatePatientInsurance( { commit }, patientInsurance ) {

		const response = await axios.post(`/api/patientInsurances/${patientInsurance.id}`, patientInsurance.formData);

		commit('editPatientInsurance', response.data.patientInsurance);

		return response;

	},

	async showPatientInsuranceById( { commit }, id) {

		const response = await axios.get(`/api/patientInsurances/${id}`);

		commit('viewPatientInsuranceById', response.data);

		return response;

	}

};

const mutations= {
	
	setPatientInsurances: (state, patientInsurances) => (state.patientInsurances = patientInsurances),

	newPatientInsurance: (state, patientInsurance) => state.patientInsurances.unshift(patientInsurance),

	removePatientInsurance: (state, id) => state.patientInsurances = state.patientInsurances.filter(patientInsurance => patientInsurance.id !== id),

	viewPatientInsuranceById: (state, data) => state.patientInsurances.filter(patientInsurance => patientInsurance.id === data.id),

	editPatientInsurance: (state, updPatientInsurance) => {
		const index = state.patientInsurances.findIndex(patientInsurance => patientInsurance.id === updPatientInsurance.id);
		if(index !== -1) {
			state.patientInsurances.splice(index, 1, updPatientInsurance);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}