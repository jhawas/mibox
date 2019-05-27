const state = {

	vitalSigns: [],

};

const getters= {
	
	allVitalSigns: (state) => state.vitalSigns,

};

const actions= {
	
	async fetchVitalSigns({ commit }) {

		const response = await axios.get(`/api/vitalSigns`);
		
		commit('setVitalSigns', response.data);

	},

	async addVitalSign( { commit }, formData ) {

		const response = await axios.post(`/api/vitalSigns`, formData);

		commit('newVitalSign', response.data);

		return response;

	},

	async deleteVitalSign({ commit }, id) {

		const response = await axios.delete(`/api/vitalSigns/${id}`);

		commit('removeVitalSign', id);

		return response;

	},

	async updateVitalSign( { commit }, vitalSign ) {

		const response = await axios.post(`/api/vitalSigns/${vitalSign.id}`, vitalSign.formData);

		commit('editVitalSign', response.data);

		return response;

	},

	async showVitalSignById( { commit }, id) {

		const response = await axios.get(`/api/vitalSigns/${id}`);

		commit('viewVitalSignById', response.data);

		return response;

	}

};

const mutations= {
	
	setVitalSigns: (state, vitalSigns) => (state.vitalSigns = vitalSigns),

	newVitalSign: (state, vitalSign) => state.vitalSigns.unshift(vitalSign),

	removeVitalSign: (state, id) => state.vitalSigns = state.vitalSigns.filter(vitalSign => vitalSign.id !== id),

	viewVitalSignById: (state, data) => state.vitalSigns.filter(vitalSign => vitalSign.id === data.id),

	editVitalSign: (state, updVitalSign) => {
		const index = state.vitalSigns.findIndex(vitalSign => vitalSign.id === updVitalSign.id);
		if(index !== -1) {
			state.vitalSigns.splice(index, 1, updVitalSign);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}