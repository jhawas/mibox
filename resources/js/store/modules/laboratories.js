const state = {

	laboratories: [],

};

const getters= {
	
	allLaboratories: (state) => state.laboratories,

};

const actions= {
	
	async fetchLaboratories({ commit }) {

		const response = await axios.get(`/api/laboratories`);
		
		commit('setLaboratories', response.data);

	},

	async addLaboratory( { commit }, formData ) {

		const response = await axios.post(`/api/laboratories`, formData);

		commit('newLaboratory', response.data);

		return response;

	},

	async deleteLaboratory({ commit }, id) {

		const response = await axios.delete(`/api/laboratories/${id}`);

		commit('removeLaboratory', id);

		return response;

	},

	async updateLaboratory( { commit }, laboratory ) {

		const response = await axios.post(`/api/laboratories/${laboratory.id}`, laboratory.formData);

		commit('editLaboratory', response.data);

		return response;

	},

	async showLaboratoryById( { commit }, id) {

		const response = await axios.get(`/api/laboratories/${id}`);

		commit('viewLaboratoryById', response.data);

		return response;

	}

};

const mutations= {
	
	setLaboratories: (state, laboratories) => (state.laboratories = laboratories),

	newLaboratory: (state, laboratory) => state.laboratories.unshift(laboratory),

	removeLaboratory: (state, id) => state.laboratories = state.laboratories.filter(laboratory => laboratory.id !== id),

	viewLaboratoryById: (state, data) => state.laboratories.filter(laboratory => laboratory.id === data.id),

	editLaboratory: (state, updLaboratory) => {
		const index = state.laboratories.findIndex(laboratory => laboratory.id === updLaboratory.id);
		if(index !== -1) {
			state.laboratories.splice(index, 1, updLaboratory);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}