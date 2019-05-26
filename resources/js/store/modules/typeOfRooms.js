const state = {

	typeOfRooms: [],

};

const getters= {
	
	allTypeOfRooms: (state) => state.typeOfRooms,

};

const actions= {
	
	async fetchTypeOfRooms({ commit }) {

		const response = await axios.get(`/api/typeOfRooms`);
		
		commit('setTypeOfRooms', response.data);

	},

	async addTypeOfRoom( { commit }, formData ) {

		const response = await axios.post(`/api/typeOfRooms`, formData);

		commit('newTypeOfRoom', response.data);

		return response;

	},

	async deleteTypeOfRoom({ commit }, id) {

		console.log('deleteTypeOfRoom', id);

		const response = await axios.delete(`/api/typeOfRooms/${id}`);

		commit('removeTypeOfRoom', id);

		return response;

	},

	async updateTypeOfRoom( { commit }, typeOfRoom ) {

		const response = await axios.post(`/api/typeOfRooms/${typeOfRoom.id}`, typeOfRoom.formData);

		commit('editTypeOfRoom', response.data);

		return response;

	},

	async showTypeOfRoomById( { commit }, id) {

		const response = await axios.get(`/api/typeOfRooms/${id}`);

		commit('viewTypeOfRoomById', response.data);

		return response;

	}

};

const mutations= {
	
	setTypeOfRooms: (state, typeOfRooms) => (state.typeOfRooms = typeOfRooms),

	newTypeOfRoom: (state, typeOfRoom) => state.typeOfRooms.unshift(typeOfRoom),

	removeTypeOfRoom: (state, id) => state.typeOfRooms = state.typeOfRooms.filter(typeOfRoom => typeOfRoom.id !== id),

	viewTypeOfRoomById: (state, data) => state.typeOfRooms.filter(typeOfRoom => typeOfRoom.id === data.id),

	editTypeOfRoom: (state, updTypeOfRoom) => {
		const index = state.typeOfRooms.findIndex(typeOfRoom => typeOfRoom.id === updTypeOfRoom.id);
		if(index !== -1) {
			state.typeOfRooms.splice(index, 1, updTypeOfRoom);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}