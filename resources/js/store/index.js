import Vuex from 'vuex';
import Vue from 'vue';

import auth from './modules/auth';
import roles from './modules/roles';
import patients from './modules/patients';
import users from './modules/users';
import typeOfRooms from './modules/typeOfRooms';
import floors from './modules/floors';
import rooms from './modules/rooms';
import patientRecords from './modules/patientRecords';
import dispositions from './modules/dispositions';
import results from './modules/results';
import typeOfRecords from './modules/typeOfRecords';
import philhealthMemberships from './modules/philhealthMemberships';
import nurseNotes from './modules/nurseNotes';
import medicationAndTreatments from './modules/medicationAndTreatments';
import vitalSigns from './modules/vitalSigns';
import intravenousFluids from './modules/intravenousFluids';

Vue.use(Vuex);

export default new Vuex.Store({
  	modules: {
  		auth,
  		users,
  		patients,
  		roles,
  		typeOfRooms,
  		floors,
  		rooms,
  		patientRecords,
      dispositions,
      results,
      typeOfRecords,
      philhealthMemberships,
      nurseNotes,
      medicationAndTreatments,
      vitalSigns,
      intravenousFluids,
  	},
});

