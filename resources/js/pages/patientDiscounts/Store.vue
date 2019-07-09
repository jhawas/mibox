<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Patient Discount Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Patient Discount Page</a></li>
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
                                label="Discount:"
                                label-for="Discount"
                            >
                                <multiselect 
                                  v-model="form.discount" 
                                  placeholder="Select Discount" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allDiscounts" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                              label="Amount:"
                              label-for="amount"
                            >
                              <b-form-input
                                v-model="form.amount"
                                type="text"
                                placeholder="Enter amount"
                                @keypress="isNumber($event)"
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

    import { mapActions, mapGetters } from 'vuex';
    import Multiselect from 'vue-multiselect';
    
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
                  discount: {},
                  amount: 0.00,
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.form.patient_record = this.defaultBilling.patient_record ? this.defaultBilling.patient_record : {};

            this.fetchPatientRecords();
            this.fetchDiscounts();

            if(this.$route.params.id) {
                this.loading = true;
                const patientDiscount = this.showPatientDiscountById(this.$route.params.id);
                patientDiscount.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters([
              'allDiscounts',
              'allPatientRecords', 
              'defaultBilling'
            ]),

        },

        methods: {

          ...mapActions([
              'addPatientDiscount', 
              'updatePatientDiscount', 
              'showPatientDiscountById',
              'fetchPatientRecords',
              'fetchDiscounts'
            ]),

          isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
              evt.preventDefault();;
            } else {
              return true;
            }
          },

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('discount_id', this.form.discount.id ? this.form.discount.id : 0);
            formData.append('amount', this.form.amount);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updatePatientDiscount({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient discount successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'billings' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addPatientDiscount(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient discount successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'billings' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'billings' });

          }

        },
    }
</script>
