<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Medication and Treatment Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Medication and Treatment Page</a></li>
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
                              label="Medicine:"
                              label-for="medicine"
                            >
                              <b-form-input
                                v-model="form.medicine"
                                type="text"
                                placeholder="Enter medicine"
                              />
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
                  patient_record: null,
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:mm'),
                  medicine: '',
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

            if(this.$route.params.id) {
                this.loading = true;
                const medicationAndTreatment = this.showMedicationAndTreatmentById(this.$route.params.id);
                medicationAndTreatment.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters(['allMedicationAndTreatments', 'allPatientRecords']),

        },

        methods: {

          ...mapActions([
              'addMedicationAndTreatment', 
              'updateMedicationAndTreatment', 
              'showMedicationAndTreatmentById',
              'fetchPatientRecords',
            ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('date', this.form.date);
            formData.append('time', this.form.time);
            formData.append('medicine', this.form.medicine);
            formData.append('remarks', this.form.remarks);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateMedicationAndTreatment({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Medication and treatment successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'medicationAndTreatments' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addMedicationAndTreatment(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Medication and treatment successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'medicationAndTreatments' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'medicationAndTreatments' });

          }

        },
    }
</script>
