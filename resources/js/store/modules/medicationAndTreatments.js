const state = {

	medicationAndTreatments: [],

};

const getters= {
	
	allMedicationAndTreatments: (state) => state.medicationAndTreatments,

};

const actions= {
	
	async fetchMedicationAndTreatments({ commit }) {

		const response = await axios.get(`/api/medicationAndTreatments`);
		
		commit('setMedicationAndTreatments', response.data);

	},

	async addMedicationAndTreatment( { commit }, formData ) {

		const response = await axios.post(`/api/medicationAndTreatments`, formData);

		commit('newMedicationAndTreatment', response.data);

		return response;

	},

	async deleteMedicationAndTreatment({ commit }, id) {

		const response = await axios.delete(`/api/medicationAndTreatments/${id}`);

		commit('removeMedicationAndTreatment', id);

		return response;

	},

	async updateMedicationAndTreatment( { commit }, medicationAndTreatments ) {

		const response = await axios.post(`/api/medicationAndTreatments/${medicationAndTreatments.id}`, medicationAndTreatments.formData);

		commit('editMedicationAndTreatment', response.data);

		return response;

	},

	async showMedicationAndTreatmentById( { commit }, id) {

		const response = await axios.get(`/api/medicationAndTreatments/${id}`);

		commit('viewMedicationAndTreatmentById', response.data);

		return response;

	}

};

const mutations= {
	
	setMedicationAndTreatments: (state, medicationAndTreatments) => (state.medicationAndTreatments = medicationAndTreatments),

	newMedicationAndTreatment: (state, medicationAndTreatments) => state.medicationAndTreatments.unshift(medicationAndTreatments),

	removeMedicationAndTreatment: (state, id) => state.medicationAndTreatments = state.medicationAndTreatments.filter(medicationAndTreatments => medicationAndTreatments.id !== id),

	viewMedicationAndTreatmentById: (state, data) => state.medicationAndTreatments.filter(medicationAndTreatments => medicationAndTreatments.id === data.id),

	editMedicationAndTreatment: (state, updMedicationAndTreatment) => {
		const index = state.medicationAndTreatments.findIndex(medicationAndTreatments => medicationAndTreatments.id === updMedicationAndTreatment.id);
		if(index !== -1) {
			state.medicationAndTreatments.splice(index, 1, updMedicationAndTreatment);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}