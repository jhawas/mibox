const state = {

	floors: [],

};

const getters= {
	
	allFloors: (state) => state.floors,

};

const actions= {
	
	async fetchFloors({ commit }) {

		const response = await axios.get(`/api/floors`);
		
		commit('setFloors', response.data);

	},

	async addFloor( { commit }, formData ) {

		const response = await axios.post(`/api/floors`, formData);

		commit('newFloor', response.data);

		return response;

	},

	async deleteFloor({ commit }, id) {

		const response = await axios.delete(`/api/floors/${id}`);

		commit('removeFloor', id);

		return response;

	},

	async updateFloor( { commit }, floor ) {

		const response = await axios.post(`/api/floors/${floor.id}`, floor.formData);

		commit('editFloor', response.data);

		return response;

	},

	async showFloorById( { commit }, id) {

		const response = await axios.get(`/api/floors/${id}`);

		commit('viewFloorById', response.data);

		return response;

	}

};

const mutations= {
	
	setFloors: (state, floors) => (state.floors = floors),

	newFloor: (state, floor) => state.floors.unshift(floor),

	removeFloor: (state, id) => state.floors = state.floors.filter(floor => floor.id !== id),

	viewFloorById: (state, data) => state.floors.filter(floor => floor.id === data.id),

	editFloor: (state, updFloor) => {
		const index = state.floors.findIndex(floor => floor.id === updFloor.id);
		if(index !== -1) {
			state.floors.splice(index, 1, updFloor);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}