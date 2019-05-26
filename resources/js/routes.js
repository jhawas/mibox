import Home from './pages/Home';
import NotFound from './pages/NotFound';
import Login from './components/auth/Login';

import User from './pages/users/Home';
import StoreUser from './pages/users/Store';
import ShowUser from './pages/users/Show';

import Patient from './pages/patients/Home';
import StorePatient from './pages/patients/Store';
import ShowPatient from './pages/patients/Show';

import TypeOfRoom from './pages/typeOfRooms/Home';
import StoreTypeOfRoom from './pages/typeOfRooms/Store';
import ShowTypeOfRoom from './pages/typeOfRooms/Show';

import Floor from './pages/floors/Home';
import StoreFloor from './pages/floors/Store';
import ShowFloor from './pages/floors/Show';

import Room from './pages/rooms/Home';
import StoreRoom from './pages/rooms/Store';
import ShowRoom from './pages/rooms/Show';

import PatientRecord from './pages/patientRecords/Home';
import StorePatientRecord from './pages/patientRecords/Store';
import ShowPatientRecord from './pages/patientRecords/Show';

export default {

    mode: 'history',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        // auth
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        // home
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                requiresAuth: true,
            }
        },
        // users
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
        // patients
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
        // type of rooms
        {
            path: '/typeOfRooms',
            name: 'typeOfRooms',
            component: TypeOfRoom,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/typeOfRoom/:id?',
            name: 'typeOfRoom-create',
            component: StoreTypeOfRoom,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/typeOfRoom/:id/show',
            name: 'typeOfRoom-show',
            component: ShowTypeOfRoom,
            meta: {
                requiresAuth: true,
            }
        },
        // floor
        {
            path: '/floors',
            name: 'floors',
            component: Floor,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/floor/:id?',
            name: 'floor-create',
            component: StoreFloor,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/floor/:id/show',
            name: 'floor-show',
            component: ShowFloor,
            meta: {
                requiresAuth: true,
            }
        },
        // room
        {
            path: '/rooms',
            name: 'rooms',
            component: Room,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/room/:id?',
            name: 'room-create',
            component: StoreRoom,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/room/:id/show',
            name: 'room-show',
            component: ShowRoom,
            meta: {
                requiresAuth: true,
            }
        },
        // patient record
        {
            path: '/patientRecords',
            name: 'patientRecords',
            component: PatientRecord,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patientRecord/:id?',
            name: 'patientRecord-create',
            component: StorePatientRecord,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patientRecord/:id/show',
            name: 'patientRecord-show',
            component: ShowPatientRecord,
            meta: {
                requiresAuth: true,
            }
        },
    ],
    
}
