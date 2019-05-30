const state = {

	billings: [],
};

const getters= {
	
	allBillings: (state) => state.billings,

};

const actions= {
	
	async fetchBillings({ commit }) {

		const response = await axios.get(`/api/billings`);
		
		commit('setBillings', response.data);

	},

	async fetchBillingsByRecord({ commit }, patient_record) {

		const response = await axios.get(`/api/billings/patientRecord/${patient_record.id}`);
		
		commit('setBillings', response.data);

	},


	async addBilling( { commit }, formData ) {

		const response = await axios.post(`/api/billings`, formData);

		commit('newBilling', response.data);

		return response;

	},

	async deleteBilling({ commit }, id) {

		const response = await axios.delete(`/api/billings/${id}`);

		commit('removeBilling', id);

		return response;

	},

	async updateBilling( { commit }, billing ) {

		const response = await axios.post(`/api/billings/${billing.id}`, billing.formData);

		commit('editBilling', response.data);

		return response;

	},

	async showBillingById( { commit }, id) {

		const response = await axios.get(`/api/billings/${id}`);

		commit('viewBillingById', response.data);

		return response;

	}

};

const mutations= {

	setBillings: (state, billings) => (state.billings = billings),

	newBilling: (state, billing) => state.billings.unshift(billing),

	removeBilling: (state, id) => state.billings = state.billings.filter(billing => billing.id !== id),

	viewBillingById: (state, data) => state.billings.filter(billing => billing.id === data.id),

	editBilling: (state, updBilling) => {
		const index = state.billings.findIndex(billing => billing.id === updBilling.id);
		if(index !== -1) {
			state.billings.splice(index, 1, updBilling);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}