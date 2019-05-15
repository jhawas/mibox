import Home from './pages/Home';

import User from './pages/users/Home';
import StoreUser from './pages/users/Store';

export default {

    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/users',
            name: 'users',
            component: User
        },
        {
            path: '/user/:userId?',
            name: 'user-create',
            component: StoreUser
        },
    ],
    
}