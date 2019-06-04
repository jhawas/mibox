<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Vital Sign Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Vital Sign Page</a></li>
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
                              label="BP:"
                              label-for="bp"
                            >
                              <b-form-input
                                v-model="form.bp"
                                type="text"
                                placeholder="Enter BP"
                              />
                            </b-form-group>

                            <b-form-group
                              label="T:"
                              label-for="t"
                            >
                              <b-form-input
                                v-model="form.t"
                                type="text"
                                placeholder="Enter T"
                              />
                            </b-form-group>

                            <b-form-group
                              label="P:"
                              label-for="p"
                            >
                              <b-form-input
                                v-model="form.p"
                                type="text"
                                placeholder="Enter P"
                              />
                            </b-form-group>

                            <b-form-group
                              label="R:"
                              label-for="r"
                            >
                              <b-form-input
                                v-model="form.r"
                                type="text"
                                placeholder="Enter R"
                              />
                            </b-form-group>

                         </b-col>
                         <b-col col lg="6">
                            <legend>Intake</legend>
                            
                            <b-form-group
                              label="Oral:"
                              label-for="intake_oral"
                            >
                              <b-form-input
                                v-model="form.intake_oral"
                                type="number"
                                placeholder="Enter Oral"
                              />
                            </b-form-group>

                            <b-form-group
                              label="I.V.:"
                              label-for="intake_iv"
                            >
                              <b-form-input
                                v-model="form.intake_iv"
                                type="number"
                                placeholder="Enter I.V."
                              />
                            </b-form-group>

                            <b-form-group
                              label="N.G:"
                              label-for="intake_ng"
                            >
                              <b-form-input
                                v-model="form.intake_ng"
                                type="number"
                                placeholder="Enter N.G"
                              />
                            </b-form-group>
                            
                            <legend>Output</legend>
                            
                            <b-form-group
                              label="Urine:"
                              label-for="output_urine"
                            >
                              <b-form-input
                                v-model="form.output_urine"
                                type="number"
                                placeholder="Enter urine"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Stool:"
                              label-for="output_stool"
                            >
                              <b-form-input
                                v-model="form.output_stool"
                                type="number"
                                placeholder="Enter stool"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Emesis:"
                              label-for="output_emesis"
                            >
                              <b-form-input
                                v-model="form.output_emesis"
                                type="number"
                                placeholder="Enter emesis"
                              />
                            </b-form-group>

                            <b-form-group
                              label="N.G:"
                              label-for="output_ng"
                            >
                              <b-form-input
                                v-model="form.output_ng"
                                type="number"
                                placeholder="Enter N.G"
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
                  patient_record: '',
                  date: moment().format('YYYY-MM-DD'),
                  time: moment().format('HH:mm'),
                  bp: '',
                  t: '',
                  p: '',
                  r: '',
                  intake_oral: 0,
                  intake_iv: 0,
                  intake_ng: 0,
                  output_urine: 0,
                  output_stool: 0,
                  output_emesis: 0,
                  output_ng: 0,
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchAvailablePatientRecords();

            if(this.$route.params.id) {
                this.loading = true;
                const vitalSign = this.showVitalSignById(this.$route.params.id);
                vitalSign.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters(['allVitalSigns', 'allAvailablePatientRecords']),

        },

        methods: {

          ...mapActions([
              'addVitalSign', 
              'updateVitalSign', 
              'showVitalSignById',
              'fetchAvailablePatientRecords',
            ]),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('date', this.form.date);
            formData.append('time', this.form.time);
            formData.append('bp', this.form.bp);
            formData.append('t', this.form.t);
            formData.append('p', this.form.p);
            formData.append('r', this.form.r);
            formData.append('intake_oral', this.form.intake_oral);
            formData.append('intake_iv', this.form.intake_iv);
            formData.append('intake_ng', this.form.intake_ng);
            formData.append('output_urine', this.form.output_urine);
            formData.append('output_stool', this.form.output_stool);
            formData.append('output_emesis', this.form.output_emesis);
            formData.append('output_ng', this.form.output_ng);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateVitalSign({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Vital sign successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'vitalSigns' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addVitalSign(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Vital sign successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'vitalSigns' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'vitalSigns' });

          }

        },
    }
</script>
