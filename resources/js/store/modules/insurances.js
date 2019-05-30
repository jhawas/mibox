const state = {

	insurances: [],

};

const getters= {
	
	allInsurances: (state) => state.insurances,

};

const actions= {
	
	async fetchInsurances({ commit }) {

		const response = await axios.get(`/api/insurances`);
		
		commit('setInsurances', response.data);

	},

	async addInsurance( { commit }, formData ) {

		const response = await axios.post(`/api/insurances`, formData);

		commit('newInsurance', response.data);

		return response;

	},

	async deleteInsurance({ commit }, id) {

		const response = await axios.delete(`/api/insurances/${id}`);

		commit('removeInsurance', id);

		return response;

	},

	async updateInsurance( { commit }, insurance ) {

		const response = await axios.post(`/api/insurances/${insurance.id}`, insurance.formData);

		commit('editInsurance', response.data);

		return response;

	},

	async showInsuranceById( { commit }, id) {

		const response = await axios.get(`/api/insurances/${id}`);

		commit('viewInsuranceById', response.data);

		return response;

	}

};

const mutations= {
	
	setInsurances: (state, insurances) => (state.insurances = insurances),

	newInsurance: (state, insurance) => state.insurances.unshift(insurance),

	removeInsurance: (state, id) => state.insurances = state.insurances.filter(insurance => insurance.id !== id),

	viewInsuranceById: (state, data) => state.insurances.filter(insurance => insurance.id === data.id),

	editInsurance: (state, updInsurance) => {
		const index = state.insurances.findIndex(insurance => insurance.id === updInsurance.id);
		if(index !== -1) {
			state.insurances.splice(index, 1, updInsurance);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}