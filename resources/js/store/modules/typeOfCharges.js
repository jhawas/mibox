const state = {

	typeOfCharges: [],

};

const getters= {
	
	allTypeOfCharges: (state) => state.typeOfCharges,

};

const actions= {

	async fetchChargesByType({ commit }, id) {

		const response = await axios.get(`/api/typeOfCharges/types/${id}`);

		commit('setTypeOfCharges', response.data);

	},

	
	async fetchTypeOfCharges({ commit }) {

		const response = await axios.get(`/api/typeOfCharges`);
		
		commit('setTypeOfCharges', response.data);

	},

	async addTypeOfCharge( { commit }, formData ) {

		const response = await axios.post(`/api/typeOfCharges`, formData);

		commit('newTypeOfCharge', response.data);

		return response;

	},

	async deleteTypeOfCharge({ commit }, id) {

		const response = await axios.delete(`/api/typeOfCharges/${id}`);

		commit('removeTypeOfCharge', id);

		return response;

	},

	async updateTypeOfCharge( { commit }, typeOfCharge ) {

		const response = await axios.post(`/api/typeOfCharges/${typeOfCharge.id}`, typeOfCharge.formData);

		commit('editTypeOfCharge', response.data);

		return response;

	},

	async showTypeOfChargeById( { commit }, id) {

		const response = await axios.get(`/api/typeOfCharges/${id}`);

		commit('viewTypeOfChargeById', response.data);

		return response;

	}

};

const mutations= {
	
	setTypeOfCharges: (state, typeOfCharges) => (state.typeOfCharges = typeOfCharges),

	newTypeOfCharge: (state, typeOfCharge) => state.typeOfCharges.unshift(typeOfCharge),

	removeTypeOfCharge: (state, id) => state.typeOfCharges = state.typeOfCharges.filter(typeOfCharge => typeOfCharge.id !== id),

	viewTypeOfChargeById: (state, data) => state.typeOfCharges.filter(typeOfCharge => typeOfCharge.id === data.id),

	editTypeOfCharge: (state, updTypeOfCharge) => {
		const index = state.typeOfCharges.findIndex(typeOfCharge => typeOfCharge.id === updTypeOfCharge.id);
		if(index !== -1) {
			state.typeOfCharges.splice(index, 1, updTypeOfCharge);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}