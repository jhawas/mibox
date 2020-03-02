<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Doctor's Order Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Doctor's Order Page</a></li>
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
                              label="Progress Note:"
                              label-for="progress_note"
                            >
                              <b-form-textarea
                                v-model="form.progress_note"
                                placeholder="Enter progress note..."
                                rows="3"
                                max-rows="6"
                              ></b-form-textarea>

                            </b-form-group>

                            <b-form-group
                              label="Orders:"
                              label-for="orders"
                            >
                              <b-form-textarea
                                v-model="form.orders"
                                placeholder="Enter orders..."
                                rows="3"
                                max-rows="6"
                              ></b-form-textarea>

                            </b-form-group>

                         </b-col>
                         <b-col col lg="6">
                              
                              <b-form-checkbox
                                v-model="form.is_laboratory"
                                name="is_laboratory"
                                :value="1"
                                :unchecked-value="0"
                                class="form-group"
                            >
                              with laboratory
                            </b-form-checkbox>

                            <b-form-group
                                label="Laboratory:"
                                label-for="patient"
                                v-if="form.is_laboratory == 1"
                            >
                                <multiselect 
                                  v-model="form.laboratories" 
                                  placeholder="Select Laboratory" 
                                  label="charge_name" 
                                  track-by="charge_id" 
                                  :options="allTypeOfLaboratories" 
                                  :multiple="true" 
                                ></multiselect>

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
                  progress_note: '',
                  orders: '',
                  is_laboratory: 0,
                  laboratories: [],
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.form.patient_record = this.defaultDoctorsOrder.patient_record ? this.defaultDoctorsOrder.patient_record : null;

            this.fetchAvailablePatientRecords();
            this.fetchTypeOfLaboratories();

            if(this.$route.params.id) {
                this.loading = true;
                const doctorsOrder = this.showDoctorsOrderById(this.$route.params.id);
                doctorsOrder.then(response => {
                      this.form = response.data;
                      this.form.laboratories = JSON.parse(response.data.laboratories);
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters([
              'allDoctorsOrders', 
              'allAvailablePatientRecords', 
              'allTypeOfLaboratories',
              'defaultDoctorsOrder'
            ]),

        },

        methods: {

          ...mapActions([
              'addDoctorsOrder', 
              'updateDoctorsOrder', 
              'showDoctorsOrderById',
              'fetchAvailablePatientRecords',
              'fetchTypeOfLaboratories',
            ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('date', this.form.date);
            formData.append('time', this.form.time);
            formData.append('progress_note', this.form.progress_note);
            formData.append('orders', this.form.orders);
            formData.append('is_laboratory', this.form.is_laboratory);
            formData.append('laboratories', JSON.stringify(this.form.laboratories ? this.form.laboratories : []));

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateDoctorsOrder({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Doctor order successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'doctorsOrders' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addDoctorsOrder(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Doctor order successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'doctorsOrders' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'doctorsOrders' });

          }

        },
    }
</script>
