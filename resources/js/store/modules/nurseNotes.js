const state = {

	nurseNotes: [],

};

const getters= {
	
	allNurseNotes: (state) => state.nurseNotes,

};

const actions= {
	
	async fetchNurseNotes({ commit }) {

		const response = await axios.get(`/api/nurseNotes`);
		
		commit('setNurseNotes', response.data);

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