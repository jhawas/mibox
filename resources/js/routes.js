import Home from './pages/Home';

import User from './pages/users/Home';
import StoreUser from './pages/users/Store';

import Patient from './pages/patients/Home';
import StorePatient from './pages/patients/Store';
import ShowPatient from './pages/patients/Show';

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
        {
            path: '/patients',
            name: 'patients',
            component: Patient
        },
        {
            path: '/patient/:id?',
            name: 'patient-create',
            component: StorePatient
        },
        {
            path: '/patient/:id/show',
            name: 'patient-show',
            component: ShowPatient
        },
    ],
    
}