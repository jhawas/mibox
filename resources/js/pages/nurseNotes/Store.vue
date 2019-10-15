<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Nurse Notes Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Nurse Notes Page</a></li>
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
                        <div v-for="error in errors">{{ error }}</div>
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
                              label="Date:"
                              label-for="date"
                            >
                              <b-form-input
                                v-model="form.date"
                                type="date"
                                placeholder="Enter date"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Time:"
                              label-for="time"
                            >
                              <b-form-input
                                v-model="form.time"
                                type="time"
                                placeholder="Enter time"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Focus:"
                              label-for="focus"
                            >
                              <b-form-input
                                v-model="form.focus"
                                type="text"
                                placeholder="Enter focus"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Action Response:"
                              label-for="focus"
                            >
                              <b-form-textarea
                                v-model="form.action_response"
                                placeholder="Enter action response..."
                                rows="3"
                                max-rows="6"
                              ></b-form-textarea>
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
                  patient_record: {},
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:mm'),
                  focus: '',
                  action_response: '',
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {
          
            this.form.patient_record = this.defaultNurseNote.patient_record ? this.defaultNurseNote.patient_record : null;

            this.fetchPatients();
            this.fetchAvailablePatientRecords();

            if(this.$route.params.id) {
                this.loading = true;
                const nurseNote = this.showNurseNoteById(this.$route.params.id);
                nurseNote.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters([
              'allNurseNotes', 
              'allPatients', 
              'allAvailablePatientRecords',
              'defaultNurseNote'
            ]),

        },

        methods: {

          ...mapActions([
              'addNurseNote', 
              'updateNurseNote', 
              'showNurseNoteById',
              'fetchPatients',
              'fetchAvailablePatientRecords',
            ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('date', this.form.date);
            formData.append('time', this.form.time);
            formData.append('focus', this.form.focus);
            formData.append('action_response', this.form.action_response);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateNurseNote({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Nurse note successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'nurseNotes' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addNurseNote(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Nurse note successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'nurseNotes' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'nurseNotes' });

          }

        },
    }
</script>
