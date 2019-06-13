const state = {

	patientDiscounts: [],

};

const getters= {
	
	allPatientDiscounts: (state) => state.patientDiscounts,

};

const actions= {
	
	async fetchPatientDiscounts({ commit }) {

		const response = await axios.get(`/api/patientDiscounts`);
		
		commit('setPatientDiscounts', response.data);

	},

	async fetchDiscountsByRecord({ commit }, patient_record) {

		const response = await axios.get(`/api/patientDiscounts/patientRecord/${patient_record.id}`);
		
		commit('setPatientDiscounts', response.data);

	},

	async addPatientDiscount( { commit }, formData ) {

		const response = await axios.post(`/api/patientDiscounts`, formData);

		commit('newPatientDiscount', response.data.patientDiscount);

		return response;

	},

	async deletePatientDiscount({ commit }, id) {

		const response = await axios.delete(`/api/patientDiscounts/${id}`);

		commit('removePatientDiscount', id);

		return response;

	},

	async updatePatientDiscount( { commit }, patientDiscount ) {

		const response = await axios.post(`/api/patientDiscounts/${patientDiscount.id}`, patientDiscount.formData);

		commit('editPatientDiscount', response.data.patientDiscount);

		return response;

	},

	async showPatientDiscountById( { commit }, id) {

		const response = await axios.get(`/api/patientDiscounts/${id}`);

		commit('viewPatientDiscountById', response.data);

		return response;

	}

};

const mutations= {
	
	setPatientDiscounts: (state, patientDiscounts) => (state.patientDiscounts = patientDiscounts),

	newPatientDiscount: (state, patientDiscount) => state.patientDiscounts.unshift(patientDiscount),

	removePatientDiscount: (state, id) => state.patientDiscounts = state.patientDiscounts.filter(patientDiscount => patientDiscount.id !== id),

	viewPatientDiscountById: (state, data) => state.patientDiscounts.filter(patientDiscount => patientDiscount.id === data.id),

	editPatientDiscount: (state, updPatientDiscount) => {
		const index = state.patientDiscounts.findIndex(patientDiscount => patientDiscount.id === updPatientDiscount.id);
		if(index !== -1) {
			state.patientDiscounts.splice(index, 1, updPatientDiscount);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}