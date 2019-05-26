const state = {

	philhealthMemberships: [],

};

const getters= {
	
	allPhilhealthMemberships: (state) => state.philhealthMemberships,

};

const actions= {
	
	async fetchPhilhealthMemberships ({ commit }) {

		const response = await axios.get(`/api/philhealthMemberships`);
		
		commit('setPhilhealthMemberships', response.data);

	},

};

const mutations= {
	
	setPhilhealthMemberships: (state, philhealthMemberships) => (state.philhealthMemberships = philhealthMemberships),

};


export default {

	state,

	getters,

	actions,

	mutations,

}