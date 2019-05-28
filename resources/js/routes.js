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

import NurseNote from './pages/nurseNotes/Home';
import StoreNurseNote from './pages/nurseNotes/Store';
import ShowNurseNote from './pages/nurseNotes/Show';

import MedicationAndTreatment from './pages/medicationAndTreatments/Home';
import StoreMedicationAndTreatment from './pages/medicationAndTreatments/Store';
import ShowMedicationAndTreatment from './pages/medicationAndTreatments/Show';

import VitalSign from './pages/vitalSigns/Home';
import StoreVitalSign from './pages/vitalSigns/Store';
import ShowVitalSign from './pages/vitalSigns/Show';

import IntravenousFluid from './pages/intravenousFluids/Home';
import StoreIntravenousFluid from './pages/intravenousFluids/Store';
import ShowIntravenousFluid from './pages/intravenousFluids/Show';

import Diagnose from './pages/diagnoses/Home';
import StoreDiagnose from './pages/diagnoses/Store';
import ShowDiagnose from './pages/diagnoses/Show';

import PatientDiagnose from './pages/patientDiagnoses/Home';
import StorePatientDiagnose from './pages/patientDiagnoses/Store';
import ShowPatientDiagnose from './pages/patientDiagnoses/Show';

import DoctorsOrder from './pages/doctorsOrders/Home';
import StoreDoctorsOrder from './pages/doctorsOrders/Store';
import ShowDoctorsOrder from './pages/doctorsOrders/Show';

import TypeOfLaboratory from './pages/typeOfLaboratories/Home';
import StoreTypeOfLaboratory from './pages/typeOfLaboratories/Store';
import ShowTypeOfLaboratory from './pages/typeOfLaboratories/Show';

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
        // nurse note
        {
            path: '/nurseNotes',
            name: 'nurseNotes',
            component: NurseNote,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/nurseNote/:id?',
            name: 'nurseNote-create',
            component: StoreNurseNote,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/nurseNote/:id/show',
            name: 'nurseNote-show',
            component: ShowNurseNote,
            meta: {
                requiresAuth: true,
            }
        },
        // medication and treatment
        {
            path: '/medicationAndTreatments',
            name: 'medicationAndTreatments',
            component: MedicationAndTreatment,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/medicationAndTreatment/:id?',
            name: 'medicationAndTreatment-create',
            component: StoreMedicationAndTreatment,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/medicationAndTreatment/:id/show',
            name: 'medicationAndTreatment-show',
            component: ShowMedicationAndTreatment,
            meta: {
                requiresAuth: true,
            }
        },
        // vital signs
        {
            path: '/vitalSigns',
            name: 'vitalSigns',
            component: VitalSign,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/vitalSign/:id?',
            name: 'vitalSign-create',
            component: StoreVitalSign,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/vitalSign/:id/show',
            name: 'vitalSign-show',
            component: ShowVitalSign,
            meta: {
                requiresAuth: true,
            }
        },
        // intravenous fluid
        {
            path: '/intravenousFluids',
            name: 'intravenousFluids',
            component: IntravenousFluid,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/intravenousFluid/:id?',
            name: 'intravenousFluid-create',
            component: StoreIntravenousFluid,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/intravenousFluid/:id/show',
            name: 'intravenousFluid-show',
            component: ShowIntravenousFluid,
            meta: {
                requiresAuth: true,
            }
        },
        // diagnoses
        {
            path: '/diagnoses',
            name: 'diagnoses',
            component: Diagnose,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/diagnose/:id?',
            name: 'diagnose-create',
            component: StoreDiagnose,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/diagnose/:id/show',
            name: 'diagnose-show',
            component: ShowDiagnose,
            meta: {
                requiresAuth: true,
            }
        },
        // patient diganoses
        {
            path: '/patientDiagnoses',
            name: 'patientDiagnoses',
            component: PatientDiagnose,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patientDiagnose/:id?',
            name: 'patientDiagnose-create',
            component: StorePatientDiagnose,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/patientDiagnose/:id/show',
            name: 'patientDiagnose-show',
            component: ShowPatientDiagnose,
            meta: {
                requiresAuth: true,
            }
        },
        // doctors order
        {
            path: '/doctorsOrders',
            name: 'doctorsOrders',
            component: DoctorsOrder,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/doctorsOrder/:id?',
            name: 'doctorsOrder-create',
            component: StoreDoctorsOrder,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/doctorsOrder/:id/show',
            name: 'doctorsOrder-show',
            component: ShowDoctorsOrder,
            meta: {
                requiresAuth: true,
            }
        },
        // TypeOfLaboratory
        {
            path: '/typeOfLaboratories',
            name: 'typeOfLaboratories',
            component: TypeOfLaboratory,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/typeOfLaboratory/:id?',
            name: 'typeOfLaboratory-create',
            component: StoreTypeOfLaboratory,
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/typeOfLaboratory/:id/show',
            name: 'typeOfLaboratory-show',
            component: ShowTypeOfLaboratory,
            meta: {
                requiresAuth: true,
            }
        },
    ],
    
}
