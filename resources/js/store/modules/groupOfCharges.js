const state = {

	groupOfCharges: [],

};

const getters= {
	
	allGroupOfCharges: (state) => state.groupOfCharges,

};

const actions= {
	
	async fetchGroupOfCharges ({ commit }) {

		const response = await axios.get(`/api/groupOfCharges`);
		
		commit('setGroupOfCharges', response.data);

	},

};

const mutations= {
	
	setGroupOfCharges: (state, groupOfCharges) => (state.groupOfCharges = groupOfCharges),

};


export default {

	state,

	getters,

	actions,

	mutations,

}