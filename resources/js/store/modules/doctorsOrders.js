const state = {

	doctorsOrders: [],
	doctorsOrder: {},

};

const getters= {
	
	allDoctorsOrders: (state) => state.doctorsOrders,
	defaultDoctorsOrder: (state) => state.doctorsOrder,

};

const actions= {
	
	async fetchDoctorsOrders({ commit }) {

		const response = await axios.get(`/api/doctorsOrders`);
		
		commit('setDoctorsOrders', response.data);

	},

	async fetchDoctorsOrdersByParentId({ commit }, patient_record) {

		const response = await axios.get(`/api/doctorsOrders/${patient_record.id}/showByPatientId`);
		
		commit('setDoctorsOrders', response.data);

		commit('setDoctorsOrderRecord', patient_record);

	},

	async addDoctorsOrder( { commit }, formData ) {

		const response = await axios.post(`/api/doctorsOrders`, formData);

		commit('newDoctorsOrder', response.data);

		return response;

	},

	async deleteDoctorsOrder({ commit }, id) {

		const response = await axios.delete(`/api/doctorsOrders/${id}`);

		commit('removeDoctorsOrder', id);

		return response;

	},

	async updateDoctorsOrder( { commit }, doctorsOrder ) {

		const response = await axios.post(`/api/doctorsOrders/${doctorsOrder.id}`, doctorsOrder.formData);

		commit('editDoctorsOrder', response.data);

		return response;

	},

	async showDoctorsOrderById( { commit }, id) {

		const response = await axios.get(`/api/doctorsOrders/${id}`);

		commit('viewDoctorsOrderById', response.data);

		return response;

	}

};

const mutations= {
	
	setDoctorsOrders: (state, doctorsOrders) => (state.doctorsOrders = doctorsOrders),

	setDoctorsOrderRecord: (state, patient_record) => (state.doctorsOrder.patient_record = patient_record),

	newDoctorsOrder: (state, doctorsOrder) => state.doctorsOrders.unshift(doctorsOrder),

	removeDoctorsOrder: (state, id) => state.doctorsOrders = state.doctorsOrders.filter(doctorsOrder => doctorsOrder.id !== id),

	viewDoctorsOrderById: (state, data) => state.doctorsOrders.filter(doctorsOrder => doctorsOrder.id === data.id),

	editDoctorsOrder: (state, updDoctorsOrder) => {
		const index = state.doctorsOrders.findIndex(doctorsOrder => doctorsOrder.id === updDoctorsOrder.id);
		if(index !== -1) {
			state.doctorsOrders.splice(index, 1, updDoctorsOrder);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}