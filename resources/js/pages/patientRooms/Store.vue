<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Floors Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Floors Page</a></li>
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
                        <div v-for="error in errors" :key="error">{{ error }}</div>
                    </b-alert>

                    <b-form @submit="onSubmit" v-if="!loading">
                      <b-row>
                         <b-col col lg="6">

                            <b-form-group
                                label="Patient:"
                                label-for="patient"
                            >
                                <multiselect 
                                  v-model="form.patient_record" 
                                  placeholder="Select Patient" 
                                  label="full_name" 
                                  track-by="id" 
                                  :options="allAvailablePatientRecords" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                                label="Room:"
                                label-for="room"
                            >
                                <multiselect 
                                  v-model="form.room" 
                                  placeholder="Select Room" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allAvailableRooms" 
                                ></multiselect>

                            </b-form-group>
                            

                            <b-form-group
                              label="Date Started:"
                              label-for="datestarted"
                            >
                              <b-form-input
                                v-model="form.date_started"
                                type="date"
                                placeholder="Enter Date"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Time Started:"
                              label-for="timestarted"
                            >
                              <b-form-input
                                v-model="form.time_start"
                                type="time"
                                placeholder="Enter Time"
                              />
                            </b-form-group>

                            <b-form-group
                              label="End Date:"
                              label-for="enddate"
                            >
                              <b-form-input
                                v-model="form.end_date"
                                type="date"
                                placeholder="Enter Date"
                              />
                            </b-form-group>

                            <b-form-group
                              label="End Time:"
                              label-for="endtime"
                            >
                              <b-form-input
                                v-model="form.time_start"
                                type="time"
                                placeholder="Enter Time"
                              />
                            </b-form-group>

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
                    patient_record: null,
                    room: null,
                    date_started: moment().format('YYYY-MM-DD'),
                    time_start: moment().format('HH:mm'),
                    end_date: '',
                    end_time: '' ,
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchAvailablePatientRecords();
            this.fetchRooms();

            if(this.$route.params.id) {
                this.loading = true;
                const floor = this.showPatientRoomById(this.$route.params.id);
                floor.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters([
              'allPatientRooms', 
              'allAvailablePatientRecords', 
              'allAvailableRooms'
            ]),

        },

        methods: {

          ...mapActions([
            'addPatientRoom', 
            'updatePatientRoom', 
            'showPatientRoomById', 
            'fetchAvailablePatientRecords',
            'fetchRooms'
          ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('patient_id', this.form.patient_record ? this.form.patient_record.patient_id : 0);
            formData.append('room_id', this.form.room ? this.form.room.id : 0);
            formData.append('date_started', this.form.date_started ? this.form.date_started : '');
            formData.append('time_start', this.form.time_start ? this.form.time_start : '');
            formData.append('end_date', this.form.end_date ? this.form.end_date : '');
            formData.append('end_time', this.form.end_time ? this.form.end_time : '');

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updatePatientRoom({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient room successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'patientRooms' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addPatientRoom(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient room successfully transfered.', 'Message');
                      
                      this.$router.push({ name: 'patientRooms' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'patientRooms' });

          }

        },
    }
</script>
