const state = {

	nurseNotes: [],
	nurseNote: {},
};

const getters= {
	
	allNurseNotes: (state) => state.nurseNotes,
	defaultNurseNote: (state) => state.nurseNote,
};

const actions= {
	
	async fetchNurseNotes({ commit }) {

		const response = await axios.get(`/api/nurseNotes`);
		
		commit('setNurseNotes', response.data);

	},

	async fetchNurseNotesByParentId({ commit }, patient_record) {

		const response = await axios.get(`/api/nurseNotes/${patient_record.id}/showByPatientId`);
		
		commit('setNurseNotes', response.data);

		commit('setNurseNoteRecord', patient_record);

	},

	async addNurseNote( { commit }, formData ) {

		const response = await axios.post(`/api/nurseNotes`, formData);

		commit('newNurseNote', response.data);

		return response;

	},

	async deleteNurseNote({ commit }, id) {

		const response = await axios.delete(`/api/nurseNotes/${id}`);

		commit('removeNurseNote', id);

		return response;

	},

	async updateNurseNote( { commit }, nurseNote ) {

		const response = await axios.post(`/api/nurseNotes/${nurseNote.id}`, nurseNote.formData);

		commit('editNurseNote', response.data);

		return response;

	},

	async showNurseNoteById( { commit }, id) {

		const response = await axios.get(`/api/nurseNotes/${id}`);

		commit('viewNurseNoteById', response.data);

		return response;

	}

};

const mutations= {
	
	setNurseNotes: (state, nurseNotes) => (state.nurseNotes = nurseNotes),

	setNurseNoteRecord: (state, patient_record) => (state.nurseNote.patient_record = patient_record),

	newNurseNote: (state, nurseNote) => state.nurseNotes.unshift(nurseNote),

	removeNurseNote: (state, id) => state.nurseNotes = state.nurseNotes.filter(nurseNote => nurseNote.id !== id),

	viewNurseNoteById: (state, data) => state.nurseNotes.filter(nurseNote => nurseNote.id === data.id),

	editNurseNote: (state, updNurseNote) => {
		const index = state.nurseNotes.findIndex(nurseNote => nurseNote.id === updNurseNote.id);
		if(index !== -1) {
			state.nurseNotes.splice(index, 1, updNurseNote);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}