const state = {

	typeOfLaboratories: [],

};

const getters= {
	
	allTypeOfLaboratories: (state) => state.typeOfLaboratories,

};

const actions= {
	
	async fetchTypeOfLaboratories({ commit }) {

		const response = await axios.get(`/api/typeOfLaboratories`);
		
		commit('setTypeOfLaboratories', response.data);

	},

	async addTypeOfLaboratory( { commit }, formData ) {

		const response = await axios.post(`/api/typeOfLaboratories`, formData);

		commit('newTypeOfLaboratory', response.data);

		return response;

	},

	async deleteTypeOfLaboratory({ commit }, id) {

		const response = await axios.delete(`/api/typeOfLaboratories/${id}`);

		commit('removeTypeOfLaboratory', id);

		return response;

	},

	async updateTypeOfLaboratory( { commit }, typeOfLaboratory ) {

		const response = await axios.post(`/api/typeOfLaboratories/${typeOfLaboratory.id}`, typeOfLaboratory.formData);

		commit('editTypeOfLaboratory', response.data);

		return response;

	},

	async showTypeOfLaboratoryById( { commit }, id) {

		const response = await axios.get(`/api/typeOfLaboratories/${id}`);

		commit('viewTypeOfLaboratoryById', response.data);

		return response;

	}

};

const mutations= {
	
	setTypeOfLaboratories: (state, typeOfLaboratories) => (state.typeOfLaboratories = typeOfLaboratories),

	newTypeOfLaboratory: (state, typeOfLaboratory) => state.typeOfLaboratories.unshift(typeOfLaboratory),

	removeTypeOfLaboratory: (state, id) => state.typeOfLaboratories = state.typeOfLaboratories.filter(typeOfLaboratory => typeOfLaboratory.id !== id),

	viewTypeOfLaboratoryById: (state, data) => state.typeOfLaboratories.filter(typeOfLaboratory => typeOfLaboratory.id === data.id),

	editTypeOfLaboratory: (state, updTypeOfLaboratory) => {
		const index = state.typeOfLaboratories.findIndex(typeOfLaboratory => typeOfLaboratory.id === updTypeOfLaboratory.id);
		if(index !== -1) {
			state.typeOfLaboratories.splice(index, 1, updTypeOfLaboratory);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}