<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> In Patient Page</h1>

                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">In Patient Page</a></li>
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

                    <b-alert
                      v-model="showAlert"
                      variant="danger"
                      dismissible
                    >
                        <div v-for="(error, index) in errors" :key="index">{{ error }}</div>
                    </b-alert>

                    <b-form @submit="onSubmit" v-if="!loading">
                      <b-row>
                         <b-col col lg="6">

                            <b-form-group
                                label="Patient:"
                                label-for="patient"
                            >
                                <multiselect
                                  v-model="form.patient"
                                  placeholder="Select Patient"
                                  label="full_name"
                                  track-by="id"
                                  :options="allAvailablePatients"
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                                label="Room:"
                                label-for="room"
                            >
                                <multiselect
                                  v-model="form.current_room"
                                  placeholder="Select Room"
                                  label="room_with_type"
                                  track-by="id"
                                  :options="allAvailableRooms"
                                  :disabled="this.$route.params.id > 0"
                                >
                                  <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                </multiselect>

                                <!-- <multiselect
                                    v-model="form.current_room"
                                    :options="allFloors"
                                    :multiple="false"
                                    group-values="rooms"
                                    group-label="name"
                                    :group-select="false"
                                    placeholder="Type to search"
                                    track-by="room_id"
                                    label="room_with_type"
                                    :disabled="this.$route.params.id > 0"
                                >

                              </multiselect> -->

                              <pre class="language-json"><code>{{ form.room  }}</code></pre>

                            </b-form-group>

                            <legend>Physician Details</legend>

                            <b-form-group
                                label="Doctor:"
                                label-for="doctor"
                            >
                                <multiselect
                                  v-model="form.physician"
                                  placeholder="Select Doctor"
                                  label="full_name"
                                  track-by="id"
                                  :options="allUsers"
                                ></multiselect>

                            </b-form-group>

                            <legend>Diagnoses</legend>

                            <b-form-group
                                label="Diagnoses:"
                                label-for="diagnoses"
                            >
                                <multiselect
                                  v-model="form.current_diagnose"
                                  placeholder="Select Diagnoses"
                                  label="diagnose_name"
                                  track-by="diagnose_id"
                                  :options="allDiagnoses"
                                  @input="onDiagnosesChange"
                                  :disabled="this.$route.params.id > 0"
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                              label="Description:"
                              label-for="description"
                            >
                              <b-form-textarea
                                v-model="form.description"
                                placeholder="Enter Description..."
                                rows="3"
                                max-rows="6"
                                :disabled="this.$route.params.id > 0"
                              ></b-form-textarea>
                            </b-form-group>

                            <b-form-group
                              label="Remarks:"
                              label-for="remarks"
                            >
                              <b-form-textarea
                                v-model="form.remarks"
                                placeholder="Enter remarks..."
                                rows="3"
                                max-rows="6"
                                :disabled="this.$route.params.id > 0"
                              ></b-form-textarea>
                            </b-form-group>

                            <legend>Vital Sign</legend>

                            <b-form-group
                              label="BP (mm/hg):"
                              label-for="bp"
                            >
                              <b-form-input
                                v-model="form.current_vital_sign.bp"
                                type="text"
                                placeholder="Enter BP"
                                :disabled="this.$route.params.id > 0"
                              />
                            </b-form-group>

                            <b-form-group
                              label="T (°C):"
                              label-for="t"
                            >
                              <b-form-input
                                v-model="form.current_vital_sign.t"
                                type="text"
                                placeholder="Enter T"
                                :disabled="this.$route.params.id > 0"
                              />
                            </b-form-group>

                            <b-form-group
                              label="P (bit/minute):"
                              label-for="p"
                            >
                              <b-form-input
                                v-model="form.current_vital_sign.p"
                                type="text"
                                placeholder="Enter P"
                                :disabled="this.$route.params.id > 0"
                              />
                            </b-form-group>

                            <b-form-group
                              label="RR (cycle/minute):"
                              label-for="r"
                            >
                              <b-form-input
                                v-model="form.current_vital_sign.r"
                                type="text"
                                placeholder="Enter R"
                                :disabled="this.$route.params.id > 0"
                              />
                            </b-form-group>

                            <legend>Other Details</legend>
                            <b-form-group
                                label="Disposition:"
                                label-for="disposition"
                            >
                                <multiselect
                                  v-model="form.disposition"
                                  placeholder="Select Disposition"
                                  label="name"
                                  track-by="id"
                                  :options="allDispositions"
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                                label="Result:"
                                label-for="result"
                            >
                                <multiselect
                                  v-model="form.result"
                                  placeholder="Select Result"
                                  label="name"
                                  track-by="id"
                                  :options="allResults"
                                ></multiselect>

                            </b-form-group>

                             <b-form-group
                                label="Philhealth Membership:"
                                label-for="philhealth_membership"
                            >
                                <multiselect
                                  v-model="form.philhealth_membership"
                                  placeholder="Select Philhealth Membership"
                                  label="name"
                                  track-by="id"
                                  :options="allPhilhealthMemberships"
                                ></multiselect>

                            </b-form-group>

                         </b-col>

                         <b-col col lg="6">

                            <b-form-group
                              label="Cheif Complaints:"
                              label-for="cheifComplaints"
                            >
                              <b-form-textarea
                                v-model="form.chief_complaints"
                                placeholder="Enter cheif complaints..."
                                rows="3"
                                max-rows="6"
                              ></b-form-textarea>
                            </b-form-group>

                            <b-form-group
                              label="Breif History:"
                              label-for="breifHistory"
                            >
                              <b-form-textarea
                                v-model="form.brief_history"
                                placeholder="Enter brief history..."
                                rows="3"
                                max-rows="6"
                              ></b-form-textarea>
                            </b-form-group>

                            <legend>Admission Details</legend>

                            <b-form-group
                                label="Doctor:"
                                label-for="doctor"
                            >
                                <multiselect
                                  v-model="form.admit_and_check_by"
                                  placeholder="Select Doctor"
                                  label="full_name"
                                  track-by="id"
                                  :options="allUsers"
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                              label="Date:"
                              label-for="date"
                            >
                              <b-form-input
                                v-model="form.admit_and_check_date"
                                type="date"
                                placeholder="Enter Date"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Time:"
                              label-for="time"
                            >
                              <b-form-input
                                v-model="form.admit_and_check_time"
                                type="time"
                                placeholder="Enter Time"
                              />
                            </b-form-group>

                            <div class="admitted-section">
                                <legend>Discharged Details</legend>

                                <b-form-checkbox
                                    v-model="form.for_discharge"
                                    name="for_discharge"
                                    :value="1"
                                    :unchecked-value="0"
                                    class="form-group"
                                    :disabled="!hasAccess('update-doctorsOrder') || !this.$route.params.id > 0"
                                    @change="onChangeForDischarge($event)"
                                >
                                  For Discharge
                                </b-form-checkbox>

                                <b-form-group
                                    label="Doctor:"
                                    label-for="doctor"
                                >
                                    <multiselect
                                      v-model="form.discharged_by"
                                      placeholder="Select Doctor"
                                      label="full_name"
                                      track-by="id"
                                      :options="allUsers"
                                    ></multiselect>

                                </b-form-group>

                                <b-form-group
                                  label="Date:"
                                  label-for="date"
                                >
                                  <b-form-input
                                    v-model="form.discharged_date"
                                    type="date"
                                    placeholder="Enter Date"
                                  />
                                </b-form-group>

                                <b-form-group
                                  label="Time:"
                                  label-for="time"
                                >
                                  <b-form-input
                                    v-model="form.discharged_time"
                                    type="time"
                                    placeholder="Enter Time"
                                  />
                                </b-form-group>
                            </div>

                            <legend>Chart Details</legend>

                            <b-form-group
                                label="Completed By:"
                                label-for="staff"
                            >
                                <multiselect
                                  v-model="form.chart_completed_by"
                                  placeholder="Select Staff"
                                  label="full_name"
                                  track-by="id"
                                  :options="allUsers"
                                ></multiselect>

                            </b-form-group>

                            <b-form-checkbox
                                v-model="form.discharged"
                                name="discharged"
                                :value="1"
                                :unchecked-value="0"
                                class="form-group"
                                :disabled="!form.for_discharge"
                            >
                              Discharged
                            </b-form-checkbox>

                         </b-col>
                      </b-row>
                      <b-button type="submit" variant="primary" :disabled="loadSubmit">
                          <b-spinner small label="Small Spinner" v-if="loadSubmit"></b-spinner>
                          Save
                      </b-button>
                      <b-button type="button" variant="secondary" @click="cancel">Cancel</b-button>
                    </b-form>
                </div>
              </div>
           </div>
        </div>
    </Layout>
</template>

<script>

    import toastr from 'toastr';
    import Layout from '../../components/Layout';
    import { FulfillingBouncingCircleSpinner } from 'epic-spinners';
    import Multiselect from 'vue-multiselect';
    import moment from 'moment';

    import { mapActions, mapGetters } from 'vuex';

    export default {
        components: {
            Layout,
            FulfillingBouncingCircleSpinner,
            Multiselect,
        },

        props: {
            props: ['id'],
        },

        data() {
            return {
                form: {
                  patient: null,
                  current_room: null,
                  disposition: null,
                  result: null,
                  philhealth_membership: null,
                  chief_complaints: '',
                  brief_history: '',
                  admit_and_check_by: null,
                  admit_and_check_date: moment().format('YYYY-MM-DD'),
                  admit_and_check_time: moment().format('HH:mm'),
                  discharged_by: null,
                  discharged_date: '',
                  discharged_time: '',
                  physician: null,
                  chart_completed_by: null,
                  discharged: 0,
                  for_discharge: 0,
                  current_diagnose: null,
                  current_vital_sign: {
                    bp: '',
                    t: '',
                    p: '',
                    r: ''
                  },
                  description: '',
                  remarks: '',
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchAvailablePatients();
            this.fetchRooms();
            this.fetchDispositions();
            this.fetchResults();
            this.fetchTypeOfRecords();
            this.fetchPhilhealthMemberships();
            this.fetchUsers();
            this.fetchDiagnoses();

            if(this.$route.params.id) {
                this.loading = true;
                const patientRecord = this.showPatientRecordById(this.$route.params.id);
                patientRecord.then(response => {
                      this.form = response.data;
                      this.form.description = response.data.current_diagnose.description;
                      this.form.remarks = response.data.current_diagnose.remarks;
                      this.form.current_vital_sign = response.data.current_vital_sign;
                      this.loading = false;
                });
            }

        },

        computed: {

            ...mapGetters([
                'allPatientRecords',
                'allAvailablePatients',
                'allAvailableRooms',
                'allDispositions',
                'allResults',
                'allTypeOfRecords',
                'allPhilhealthMemberships',
                'allUsers',
                'allDiagnoses',
                'hasAccess',
              ]),

        },

        methods: {

          ...mapActions([
              'addPatientRecord',
              'updatePatientRecord',
              'showPatientRecordById',
              'fetchAvailablePatients',
              'fetchRooms',
              'fetchDispositions',
              'fetchResults',
              'fetchTypeOfRecords',
              'fetchPhilhealthMemberships',
              'fetchUsers',
              'fetchDiagnoses'
            ]),

          onDiagnosesChange(value) {
              this.form.description = value.description;
          },

          onChangeForDischarge(value) {
              if(value) {
                  this.form.discharged_date = moment().format('YYYY-MM-DD');
                  this.form.discharged_time = moment().format('HH:mm');
              } else {
                  this.form.discharged_date = null;
                  this.form.discharged_time = null;
              }
          },

          onSubmit(event) {

            event.preventDefault();

            this.loadSubmit = true;

            let formData = new FormData();

            formData.append('patient_id', this.form.patient ? this.form.patient.id : null);

            formData.append('disposition_id', this.form.disposition ? this.form.disposition.id : 0);
            formData.append('result_id', this.form.result ? this.form.result.id : 0);
            formData.append('philhealth_membership_id', this.form.philhealth_membership ? this.form.philhealth_membership.id : 0);
            formData.append('chief_complaints', this.form.chief_complaints);
            formData.append('brief_history', this.form.brief_history);
            formData.append('admit_and_check_by', this.form.admit_and_check_by ? this.form.admit_and_check_by.id : 0);
            formData.append('admit_and_check_date', this.form.admit_and_check_date);
            formData.append('admit_and_check_time', this.form.admit_and_check_time);
            formData.append('discharged_by', this.form.discharged_by ? this.form.discharged_by.id : 0);
            formData.append('discharged_date', this.form.discharged_date);
            formData.append('discharged_time', this.form.discharged_time);
            formData.append('physician_id', this.form.physician ? this.form.physician.id : 0);
            formData.append('chart_completed_by', this.form.chart_completed_by ? this.form.chart_completed_by.id : 0);
            formData.append('discharged', this.form.discharged);
            formData.append('for_discharge', this.form.for_discharge);

            formData.append('description', this.form.description);
            formData.append('remarks', this.form.remarks);

            if(this.$route.params.id > 0) {


              formData.append('_method', 'PUT');

              const response = this.updatePatientRecord({id: this.$route.params.id, formData: formData});

              response.then( response => {

                  console.log(response.data);

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient record successfully updated.', 'Message');

                      this.$router.push({ name: 'patientRecords' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();

              });

            } else {

              formData.append('room_id', this.form.current_room ? this.form.current_room.id : 0);

              formData.append('diagnose_id', this.form.current_diagnose ? this.form.current_diagnose.id : 0);

              formData.append('bp', this.form.current_vital_sign.bp);
              formData.append('t', this.form.current_vital_sign.t);
              formData.append('p', this.form.current_vital_sign.p);
              formData.append('r', this.form.current_vital_sign.r);

              const response = this.addPatientRecord(formData);

              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient record successfully saved.', 'Message');

                      this.$router.push({ name: 'patientRecords' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });

            }

          },

          cancel() {

            this.$router.push({ name: 'patientRecords' });

          }

        },
    }
</script>
