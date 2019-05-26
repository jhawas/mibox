const state = {

	rooms: [],

};

const getters= {
	
	allRooms: (state) => state.rooms,

};

const actions= {
	
	async fetchRooms({ commit }) {

		const response = await axios.get(`/api/rooms`);
		
		commit('setRooms', response.data);

	},

	async addRoom( { commit }, formData ) {

		const response = await axios.post(`/api/rooms`, formData);

		commit('newRoom', response.data);

		return response;

	},

	async deleteRoom({ commit }, id) {

		const response = await axios.delete(`/api/rooms/${id}`);

		commit('removeRoom', id);

		return response;

	},

	async updateRoom( { commit }, room ) {

		const response = await axios.post(`/api/rooms/${room.id}`, room.formData);

		commit('editRoom', response.data);

		return response;

	},

	async showRoomById( { commit }, id) {

		const response = await axios.get(`/api/rooms/${id}`);

		commit('viewRoomById', response.data);

		return response;

	}

};

const mutations= {
	
	setRooms: (state, rooms) => (state.rooms = rooms),

	newRoom: (state, room) => state.rooms.unshift(room),

	removeRoom: (state, id) => state.rooms = state.rooms.filter(room => room.id !== id),

	viewRoomById: (state, data) => state.rooms.filter(room => room.id === data.id),

	editRoom: (state, updRoom) => {
		const index = state.rooms.findIndex(room => room.id === updRoom.id);
		if(index !== -1) {
			state.rooms.splice(index, 1, updRoom);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}