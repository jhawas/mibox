import toastr from 'toastr';

export function initialize(store, router) {

    // get all data need by default;    
    store.dispatch('fetchRoles');

    router.beforeEach((to, from, next) => {
        
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        
        const currentUser = store.state.auth.currentUser;
    
        if(requiresAuth && !currentUser) {

            next('/login');

        } else if(to.path == '/login' && currentUser) {

            next('/');

        } else {

            next();

        }
    });

    // Add a request interceptor
    axios.interceptors.request.use(function (config) {
        // Do something before request is sent
        return config;
      
      }, function (error) {
        
        toastr.error(error, 'Request');
        // Do something with request errors
        
        return Promise.reject(error);
      
      });

    // Add a response interceptor
    axios.interceptors.response.use(function (response) {
        // Do something with response data
      return response;

    }, function (error) {

        if(error.response.status === 401) {

          store.commit('logout');

          router.push({ name: 'login' });

        }
    
        toastr.error(error.response.data.message, error);

        // Do something with response error
        return Promise.reject(error);
      
    });

    if (store.getters.currentUser) {

        setAuthorization(store.getters.currentUser.token);

    }
}

export function setAuthorization(token) {
    window.axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
    window.axios.defaults.headers.post['Content-Type'] = 'application/json';
}