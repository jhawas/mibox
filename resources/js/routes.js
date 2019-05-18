import Home from './pages/Home';
import NotFound from './pages/NotFound';
import Login from './components/auth/Login';

import User from './pages/users/Home';
import StoreUser from './pages/users/Store';
import ShowUser from './pages/users/Show';

import Patient from './pages/patients/Home';
import StorePatient from './pages/patients/Store';
import ShowPatient from './pages/patients/Show';

export default {

    mode: 'history',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/users',
            name: 'users',
            component: User,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/user/:id?',
            name: 'user-create',
            component: StoreUser,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/user/:id/show',
            name: 'user-show',
            component: ShowUser,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patients',
            name: 'patients',
            component: Patient,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patient/:id?',
            name: 'patient-create',
            component: StorePatient,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patient/:id/show',
            name: 'patient-show',
            component: ShowPatient,
            meta: {
                requiresAuth: true,
            }
        },
    ],
    
}
