const state = {

	intravenousFluids: [],

};

const getters= {
	
	allIntravenousFluids: (state) => state.intravenousFluids,

};

const actions= {
	
	async fetchIntravenousFluids({ commit }) {

		const response = await axios.get(`/api/intravenousFluids`);
		
		commit('setIntravenousFluids', response.data);

	},

	async addIntravenousFluid( { commit }, formData ) {

		const response = await axios.post(`/api/intravenousFluids`, formData);

		commit('newIntravenousFluid', response.data);

		return response;

	},

	async deleteIntravenousFluid({ commit }, id) {

		const response = await axios.delete(`/api/intravenousFluids/${id}`);

		commit('removeIntravenousFluid', id);

		return response;

	},

	async updateIntravenousFluid( { commit }, intravenousFluid ) {

		const response = await axios.post(`/api/intravenousFluids/${intravenousFluid.id}`, intravenousFluid.formData);

		commit('editIntravenousFluid', response.data);

		return response;

	},

	async showIntravenousFluidById( { commit }, id) {

		const response = await axios.get(`/api/intravenousFluids/${id}`);

		commit('viewIntravenousFluidById', response.data);

		return response;

	}

};

const mutations= {
	
	setIntravenousFluids: (state, intravenousFluid) => (state.intravenousFluids = intravenousFluid),

	newIntravenousFluid: (state, intravenousFluid) => state.intravenousFluids.unshift(intravenousFluid),

	removeIntravenousFluid: (state, id) => state.intravenousFluids = state.intravenousFluids.filter(intravenousFluid => intravenousFluid.id !== id),

	viewIntravenousFluidById: (state, data) => state.intravenousFluids.filter(intravenousFluid => intravenousFluid.id === data.id),

	editIntravenousFluid: (state, updIntravenousFluid) => {
		const index = state.intravenousFluids.findIndex(intravenousFluid => intravenousFluid.id === updIntravenousFluid.id);
		if(index !== -1) {
			state.intravenousFluids.splice(index, 1, updIntravenousFluid);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}