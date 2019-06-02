<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Intravenous Fluid Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Intravenous Fluid Page</a></li>
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
                              label="Bot no.:"
                              label-for="bot_no"
                            >
                              <b-form-input
                                v-model="form.bot_no"
                                type="number"
                                placeholder="Enter bot no."
                              />
                            </b-form-group>

                            <b-form-group
                              label="Kind Of Solution:"
                              label-for="kind_of_solution"
                            >
                              <multiselect 
                                  v-model="form.type_of_charge" 
                                  placeholder="Select kind of solution" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allTypeOfCharges" 
                              ></multiselect>
                            
                            </b-form-group>

                            <b-form-group
                              label="Quantity:"
                              label-for="quantity"
                            >
                              <b-form-input
                                v-model="form.quantity"
                                type="number"
                                placeholder="Enter quantity"
                              />
                            
                            </b-form-group>

                            <b-form-group
                              label="Vol.:"
                              label-for="vol"
                            >
                              <b-form-input
                                v-model="form.vol"
                                type="text"
                                placeholder="Enter vol."
                              />
                            
                            </b-form-group>

                            <b-form-group
                              label="GTSS:"
                              label-for="gtss"
                            >
                              <b-form-input
                                v-model="form.gtss"
                                type="text"
                                placeholder="Enter gtss."
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
                  patient_record: '',
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:mm'),
                  bot_no: '',
                  type_of_charge: {},
                  vol: '',
                  gtss: '',
                  remarks: '',
                  quantity: 1,
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchPatientRecords();
            this.fetchChargesByType(4); //intravenous fluid

            if(this.$route.params.id) {
                this.loading = true;
                const intravenousFluid = this.showIntravenousFluidById(this.$route.params.id);
                intravenousFluid.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters([
              'allIntravenousFluids', 
              'allPatients', 
              'allPatientRecords',
              'allTypeOfCharges'
            ]),

        },

        methods: {

          ...mapActions([
              'addIntravenousFluid', 
              'updateIntravenousFluid', 
              'showIntravenousFluidById',
              'fetchPatientRecords',
              'fetchChargesByType'
            ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('date', this.form.date);
            formData.append('time', this.form.time);
            formData.append('bot_no', this.form.bot_no);
            formData.append('type_of_charge_id', this.form.type_of_charge ? this.form.type_of_charge.id : 0);
            formData.append('quantity', this.form.quantity);
            formData.append('vol', this.form.vol);
            formData.append('gtss', this.form.gtss);
            formData.append('remarks', this.form.remarks);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateIntravenousFluid({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Intravenous fluid successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'intravenousFluids' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addIntravenousFluid(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Intravenous fluid successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'intravenousFluids' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'intravenousFluids' });

          }

        },
    }
</script>
