<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> In Patient Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#" @click="cancel">In Patient Page</a></li>
                </ul>
            </div>
          <div class="row">
            <fulfilling-bouncing-circle-spinner
              :animation-duration="4000"
              :size="60"
              color="#009688"
              class="ibox-spinner"
              v-if="loading"
            />
            <div class="col-md-12" v-if="!loading">
              <div class="tile">
                <div class="tile-body">
                    <div>
                      <b-tabs content-class="mt-3" fill>
                        <b-tab title="Informtation" active>
                          <b-row>
                            <b-col col md="6">

                                <b-form-group label-cols="4" label-cols-lg="4" label="Name" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.full_name }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Room" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.current_room ? patientRecord.current_room.room_with_type : null }}</div>
                                </b-form-group>

                                <legend>Physician Details</legend>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Doctor" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.physician ? patientRecord.physician.full_name : null }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Cheif Complaints" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.cheif_complaints}}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Breif history" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.breif_history}}</div>
                                </b-form-group>

                                <legend>Other Details</legend>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Disposition" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.disposition ? patientRecord.disposition.name : null }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Result" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.result ? patientRecord.result.name : null }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Philhealth Membership" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.philhealth_membership ? patientRecord.philhealth_membership.name : null }}</div>
                                </b-form-group>
                            </b-col>

                            <b-col col md="6">
                                <legend>Admission Details</legend>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Doctor" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.admit_and_check_by ? patientRecord.admit_and_check_by.full_name : null }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Date" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.admit_and_check_date }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Time" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.admit_and_check_time }}</div>
                                </b-form-group>

                                <legend>Discharged Details</legend>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Doctor" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.discharged_by ? patientRecord.discharged_by.full_name : null }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Date" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.discharged_date }}</div>
                                </b-form-group>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Time" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.discharged_time }}</div>
                                </b-form-group>

                                <legend>Chart Details</legend>

                                <b-form-group label-cols="4" label-cols-lg="4" label="Completed by" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.chart_completed_by ? patientRecord.chart_completed_by.full_name : null }}</div>
                                </b-form-group>

                            </b-col>


                          </b-row>
                        </b-tab>
                        <b-tab title="Diagnoses">
                            <patient-diagnoses-table
                                :items="patientRecord.patient_diagnoses"
                            ></patient-diagnoses-table>
                        </b-tab>
                        <b-tab title="Nurse Note">
                          <nurse-notes-table
                                :items="patientRecord.nurse_notes"
                          ></nurse-notes-table>
                        </b-tab>
                        <b-tab title="Medication And Treatment">
                          <medication-and-treatments-table
                                :items="patientRecord.medication_and_treatments"
                          ></medication-and-treatments-table>
                        </b-tab>
                        <b-tab title="Vital Sign">
                            <vital-signs-table
                                :items="patientRecord.vital_signs"
                          ></vital-signs-table>
                        </b-tab>
                        <b-tab title="Intravenous Fluid">
                          <intravenous-fluids-table
                                :items="patientRecord.intravenous_fluids"
                          ></intravenous-fluids-table>
                        </b-tab>
                        <b-tab title="Doctor's Order">
                          <doctors-orders-table
                                :items="patientRecord.doctors_orders"
                          ></doctors-orders-table>
                        </b-tab>
                        <b-tab title="Laboratory">
                          <laboratories-table
                                :items="patientRecord.laboratories"
                          ></laboratories-table>
                        </b-tab>
                      </b-tabs>
                    </div>
                </div>
              </div>
          </div>
        </div>
        <b-button type="button" variant="secondary" @click="cancel">Back</b-button>
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
                patientRecord: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allPatientRecords']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const patientRecord = this.showPatientRecordById(this.$route.params.id);

                patientRecord.then(response => {

                    this.loading = false;

                    this.patientRecord = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showPatientRecordById']),

          cancel(event) {

            event.preventDefault();

            this.$router.push({ name: 'patientRecords' });

          }

        },
    }
</script>
