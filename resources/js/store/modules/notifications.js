const state = {
    notifications: [],
    unReadNotifications: [],
};

const getters = {
    allNotifications: state => state.notifications,
    allUnReadNotifications: state => state.unReadNotifications
};

const actions = {
    async fetchNotifications({ commit }) {
        const response = await axios.get(`/api/notifications/read`);
        commit("setNotifications", response.data);
    },

    async fetchUnReadNotifications({ commit }) {
        const response = await axios.get(`/api/notifications/unRead`);
        commit("setUnReadNotifications", response.data);
    },

    async markAllAsRead({ commit }, formData) {

        const response = await axios.post(`/api/notifications/markAsAllRead`, formData);

        commit('markedAllRead', response.data);

        return response;

    },
};

const mutations = {
    setNotifications: (state, notifications) => (state.notifications = notifications),
    setUnReadNotifications: (state, unReadNotifications) => (state.unReadNotifications = unReadNotifications),
    markedAllRead: (state, unReadNotifications) => {},
};

export default {
    state,

    getters,

    actions,

    mutations
};
