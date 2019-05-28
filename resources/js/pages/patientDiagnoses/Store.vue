<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Patient Diagnoses Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Patient Diagnoses Page</a></li>
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
                                  :options="allPatientRecords" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                                label="Diagnose:"
                                label-for="diagnose"
                            >
                                <multiselect 
                                  v-model="form.diagnose" 
                                  placeholder="Select Diagnoses" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allDiagnoses" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                              label="Description:"
                              label-for="description"
                            >
                              <b-form-textarea
                                v-model="form.description"
                                placeholder="Enter description..."
                                rows="3"
                                max-rows="6"
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
                  patient_record: '',
                  diagnose: '',
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

            this.fetchPatientRecords();
            this.fetchDiagnoses();

            if(this.$route.params.id) {
                this.loading = true;
                const patientDiagnose = this.showPatientDiagnoseById(this.$route.params.id);
                patientDiagnose.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters(['allPatientDiagnoses', 'allDiagnoses', 'allPatientRecords']),

        },

        methods: {

          ...mapActions([
              'addPatientDiagnose', 
              'updatePatientDiagnose', 
              'showPatientDiagnoseById',
              'fetchDiagnoses',
              'fetchPatientRecords',
            ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('diagnose_id', this.form.diagnose ? this.form.diagnose.id : 0);
            formData.append('description', this.form.description);
            formData.append('remarks', this.form.remarks);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updatePatientDiagnose({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient diagnoses successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'patientDiagnoses' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addPatientDiagnose(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient diagnoses successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'patientDiagnoses' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'patientDiagnoses' });

          }

        },
    }
</script>
