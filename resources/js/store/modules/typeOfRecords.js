const state = {

	typeOfRecords: [],

};

const getters= {
	
	allTypeOfRecords: (state) => state.typeOfRecords,

};

const actions= {
	
	async fetchTypeOfRecords ({ commit }) {

		const response = await axios.get(`/api/typeOfRecords`);
		
		commit('setTypeOfRecords', response.data);

	},

};

const mutations= {
	
	setTypeOfRecords: (state, typeOfRecords) => (state.typeOfRecords = typeOfRecords),

};


export default {

	state,

	getters,

	actions,

	mutations,

}