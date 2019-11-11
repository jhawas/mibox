<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Patient Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Patient Page</a></li>
                </ul>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                    <fulfilling-bouncing-circle-spinner
                      :animation-duration="4000"
                      :size="60"
                      color="#009688"
                      v-if="loading"
                      class="ibox-spinner"
                    />
                    <div v-if="!loading">
                        <b-tabs content-class="mt-3" fill>
                          <b-tab title="Informtation" active>
                              <b-row>
                                <b-col col md="6">
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Case No." label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.case_no }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="First Name" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.first_name }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Middle Name" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.middle_name }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Last Name" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.last_name }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Suffix" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.suffix }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Birthdate" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.birthdate }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Sex" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.sex }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Religion" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.religion }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Address" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.address }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Civil Status" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.civil_status }}</div>
                                    </b-form-group>
                                </b-col>
                                <b-col col md="6">
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Father" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.father }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Mother" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.mother }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Spouse" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.spouse }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Spouse Adress" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.spouse_address }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Contact No." label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.contact_no }}</div>
                                    </b-form-group>
                                    <legend>Emergency Contact</legend>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Name" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.e_name }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Contact" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.e_contact }}</div>
                                    </b-form-group>
                                    <b-form-group label-cols="4" label-cols-lg="2" label="Address" label-for="input-default">
                                      <div class="form-control form-group-value">{{ patient.e_address }}</div>
                                    </b-form-group>
                                </b-col>
                              </b-row>
                          </b-tab>
                          <b-tab title="History">
                              <div v-for="(patient_record, index) in patient.patient_records" :key="index" class="history-patient-record">
                                  <legend>{{formatDateStartEnd(patient_record.admit_and_check_date, patient_record.discharged_date)}}</legend>
                                  <b-tabs>
                                      <b-tab title="Diagnoses">
                                          <patient-diagnoses-table
                                              :items="patient_record.patient_diagnoses"
                                          ></patient-diagnoses-table>
                                      </b-tab>
                                      <b-tab title="Nurse Note">
                                        <nurse-notes-table
                                              :items="patient_record.nurse_notes"
                                        ></nurse-notes-table>
                                      </b-tab>
                                      <b-tab title="Medication And Treatment">
                                        <medication-and-treatments-table
                                              :items="patient_record.medication_and_treatments"
                                        ></medication-and-treatments-table>
                                      </b-tab>
                                      <b-tab title="Vital Sign">
                                          <vital-signs-table
                                              :items="patient_record.vital_signs"
                                        ></vital-signs-table>
                                      </b-tab>
                                      <b-tab title="Intravenous Fluid">
                                        <intravenous-fluids-table
                                              :items="patient_record.intravenous_fluids"
                                        ></intravenous-fluids-table>
                                      </b-tab>
                                      <b-tab title="Doctor's Order">
                                        <doctors-orders-table
                                              :items="patient_record.doctors_orders"
                                        ></doctors-orders-table>
                                      </b-tab>
                                      <b-tab title="Laboratory">
                                        <laboratories-table
                                              :items="patient_record.laboratories"
                                        ></laboratories-table>
                                      </b-tab>
                                  </b-tabs>
                              </div>
                          </b-tab>
                        </b-tabs>
                         <b-button type="button" variant="primary" @click="cancel">Cancel</b-button>
                    </div>
                </div>
              </div>
           </div>
        </div>
    </Layout>
</template>

<script>
    
    import Layout from '../../components/Layout';
    import { mapActions, mapGetters } from 'vuex';
    import { FulfillingBouncingCircleSpinner } from 'epic-spinners';
    import PatientDiagnosesTable from '../../components/view/PatientDiagnosesTable';
    import NurseNotesTable from '../../components/view/NurseNotesTable';
    import MedicationAndTreatmentsTable from '../../components/view/MedicationAndTreatmentsTable';
    import VitalSignsTable from '../../components/view/VitalSignsTable';
    import IntravenousFluidsTable from '../../components/view/IntravenousFluidsTable';
    import DoctorsOrdersTable from '../../components/view/DoctorsOrdersTable';
    import LaboratoriesTable from '../../components/view/LaboratoriesTable';
    import moment from 'moment';

    export default {
        components: {
            Layout,
            FulfillingBouncingCircleSpinner,
            PatientDiagnosesTable,
            NurseNotesTable,
            MedicationAndTreatmentsTable,
            VitalSignsTable,
            IntravenousFluidsTable,
            DoctorsOrdersTable,
            LaboratoriesTable,
        },

        props: {

        },

        data() {
            return {
                patient: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allPatients']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const patient = this.showPatientById(this.$route.params.id);

                patient.then(response => {

                    this.loading = false;

                    this.patient = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showPatientById']),

          formatDateStartEnd(dateStart, dateEnd) {
              const start = moment(dateStart).format('MMM DD, YYYY');
              const end   = moment(dateEnd ? dateEnd : new Date()).format('MMM DD, YYYY');
              return start + ' - ' + end;
          },

          cancel() {

            this.$router.push({ name: 'patients' });

          }

        },
    }
</script>
