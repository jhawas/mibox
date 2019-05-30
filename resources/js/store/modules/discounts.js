const state = {

	discounts: [],

};

const getters= {
	
	allDiscounts: (state) => state.discounts,

};

const actions= {
	
	async fetchDiscounts({ commit }) {

		const response = await axios.get(`/api/discounts`);
		
		commit('setDiscounts', response.data);

	},

	async addDiscount( { commit }, formData ) {

		const response = await axios.post(`/api/discounts`, formData);

		commit('newDiscount', response.data);

		return response;

	},

	async deleteDiscount({ commit }, id) {

		const response = await axios.delete(`/api/discounts/${id}`);

		commit('removeDiscount', id);

		return response;

	},

	async updateDiscount( { commit }, discount ) {

		const response = await axios.post(`/api/discounts/${discount.id}`, discount.formData);

		commit('editDiscount', response.data);

		return response;

	},

	async showDiscountById( { commit }, id) {

		const response = await axios.get(`/api/discounts/${id}`);

		commit('viewDiscountById', response.data);

		return response;

	}

};

const mutations= {
	
	setDiscounts: (state, discounts) => (state.discounts = discounts),

	newDiscount: (state, discount) => state.discounts.unshift(discount),

	removeDiscount: (state, id) => state.discounts = state.discounts.filter(discount => discount.id !== id),

	viewDiscountById: (state, data) => state.discounts.filter(discount => discount.id === data.id),

	editDiscount: (state, updDiscount) => {
		const index = state.discounts.findIndex(discount => discount.id === updDiscount.id);
		if(index !== -1) {
			state.discounts.splice(index, 1, updDiscount);
		}
	},

};


export default {

	state,

	getters,

	actions,

	mutations,

}