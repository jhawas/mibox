const state = {

	patientRooms: [],
	patientRoom: {},

};

const getters= {
	
	allPatientRooms: (state) => state.patientRooms,
	defaultPatientRoom: (state) => state.patientRoom,

};

const actions= {
	
	async fetchPatientRooms({ commit }) {

		const response = await axios.get(`/api/patientRooms`);
		
		commit('setPatientRooms', response.data);

	},

	async fetchPatientRoomsByParentId({ commit }, patient_record) {

		const response = await axios.get(`/api/patientRooms/${patient_record.id}/showByPatientId`);
		
		commit('setPatientRooms', response.data);

		commit('setPatientRoomRecord', patient_record);

	},

	async addPatientRoom( { commit }, formData ) {

		const response = await axios.post(`/api/patientRooms`, formData);

		commit('newPatientRoom', response.data);

		return response;

	},

	async deletePatientRoom({ commit }, id) {

		const response = await axios.delete(`/api/patientRooms/${id}`);

		commit('removePatientRoom', id);

		return response;

	},

	async updatePatientRoom( { commit }, patientRoom ) {

		const response = await axios.post(`/api/patientRooms/${patientRoom.id}`, patientRoom.formData);

		commit('editPatientRoom', response.data);

		return response;

	},

	async showPatientRoomById( { commit }, id) {

		const response = await axios.get(`/api/patientRooms/${id}`);

		commit('viewPatientRoomById', response.data);

		return response;

	}

};

const mutations= {
	
	setPatientRooms: (state, patientRooms) => (state.patientRooms = patientRooms),

	setPatientRoomRecord: (state, patient_record) => (state.patientRoom.patient_record = patient_record),

	newPatientRoom: (state, patientRoom) => state.patientRooms.unshift(patientRoom),

	removePatientRoom: (state, id) => state.patientRooms = state.patientRooms.filter(patientRoom => patientRoom.id !== id),

	viewPatientRoomById: (state, data) => state.patientRooms.filter(patientRoom => patientRoom.id === data.id),

	editPatientRoom: (state, updPatientRoom) => {
		const index = state.patientRooms.findIndex(patientRoom => patientRoom.id === updPatientRoom.id);
		if(index !== -1) {
			state.patientRooms.splice(index, 1, updPatientRoom);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}