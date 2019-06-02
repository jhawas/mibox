<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Patient Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Patient Page</a></li>
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
                              label="Case No:"
                              label-for="case_no"
                            >
                              <b-form-input
                                v-model="form.case_no"
                                type="text"
                                placeholder="Enter Case No."
                              />
                            </b-form-group>

                            <b-form-group
                              label="First Name:"
                              label-for="first_name"
                            >
                              <b-form-input
                                v-model="form.first_name"
                                type="text"
                                placeholder="Enter First Name"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Middle Name:"
                              label-for="middle_name"
                            >
                              <b-form-input
                                v-model="form.middle_name"
                                type="text"
                                placeholder="Enter Middle Name"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Last Name:"
                              label-for="last_name"
                            >
                              <b-form-input
                                v-model="form.last_name"
                                type="text"
                                placeholder="Enter Last Name"
                              />
                            </b-form-group>

                            <b-form-group
                              label="suffix:"
                              label-for="suffix"
                            >
                              <b-form-input
                                v-model="form.suffix"
                                type="text"
                                placeholder="Enter suffix"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Birthdate:"
                              label-for="birthdate"
                            >
                              <b-form-input
                                v-model="form.birthdate"
                                type="date"
                                placeholder="Enter birthdate"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Sex:"
                              label-for="sex"
                            >
                              <b-form-select 
                                v-model="form.sex" 
                                :options="sex"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Religion:"
                              label-for="religion"
                            >
                              <b-form-input
                                v-model="form.religion"
                                type="text"
                                placeholder="Enter religion"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Address:"
                              label-for="address"
                            >
                              <b-form-input
                                v-model="form.address"
                                type="text"
                                placeholder="Enter address"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Civil Status:"
                              label-for="civil_status"
                            >
                              <b-form-select 
                                v-model="form.civil_status" 
                                :options="civil_status"
                              />
                            </b-form-group>

                         </b-col>
                         <b-col col lg="6">

                            <b-form-group
                              label="Father:"
                              label-for="father"
                            >
                              <b-form-input
                                v-model="form.father"
                                type="text"
                                placeholder="Enter father"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Mother:"
                              label-for="mother"
                            >
                              <b-form-input
                                v-model="form.mother"
                                type="text"
                                placeholder="Enter mother"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Spouse:"
                              label-for="spouse"
                            >
                              <b-form-input
                                v-if="form.civil_status === 'married'"
                                v-model="form.spouse"
                                type="text"
                                placeholder="Enter spouse"
                              />
                            </b-form-group>

                            <b-form-group
                              v-if="form.civil_status === 'married'"
                              label="Spouse address:"
                              label-for="spouse_address"
                            >
                              <b-form-input
                                v-model="form.spouse_address"
                                type="text"
                                placeholder="Enter spouse address"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Contact No.:"
                              label-for="contact_no"
                            >
                              <b-form-input
                                v-model="form.contact_no"
                                type="text"
                                placeholder="Enter contact no"
                              />
                            </b-form-group>

                            <legend>Emegency Contact</legend>

                            <b-form-group
                              label="Name:"
                              label-for="e_name"
                            >
                              <b-form-input
                                v-model="form.e_name"
                                type="text"
                                placeholder="Enter name"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Contact:"
                              label-for="e_contact"
                            >
                              <b-form-input
                                v-model="form.e_contact"
                                type="text"
                                placeholder="Enter contact"
                              />
                            </b-form-group>

                            <b-form-group
                              label="Address:"
                              label-for="e_address"
                            >
                              <b-form-input
                                v-model="form.e_address"
                                type="text"
                                placeholder="Enter address"
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

    import { mapActions } from 'vuex';
    
    export default {
        components: {
            Layout,
            FulfillingBouncingCircleSpinner
        },

        props: {
            props: ['id'],
        },

        data() {
            return {
                civil_status: [
                  { value: '', text: 'Please select an option' },
                  { value: 'single', text: 'Single' },
                  { value: 'married', text: 'Married' },
                  { value: 'widowed', text: 'Widowed' },
                  { value: 'separated', text: 'Separated' },
                ],
                sex: [
                    { value: '', text: 'Please select an option' },
                    { value: 'male', text: 'Male' },
                    { value: 'female', text: 'Female' },
                ],
                form: {
                  case_no: '',
                  first_name: '',
                  middle_name: '',
                  last_name: '',
                  suffix: '',
                  birthdate: '',
                  sex: '',
                  religion: '',
                  address: '',
                  civil_status: '',
                  father: '',
                  mother: '',
                  spouse: '',
                  spouse_address: '',
                  contact_no: '',
                  e_name: '',
                  e_contact: '',
                  e_address: '',
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            if(this.$route.params.id) {
                this.loading = true;
                const patient = this.showPatientById(this.$route.params.id);
                patient.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
          
        },

        methods: {

          ...mapActions(['addPatient', 'updatePatient', 'showPatientById']),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('case_no', this.form.case_no);
            formData.append('first_name', this.form.first_name);
            formData.append('middle_name', this.form.middle_name);
            formData.append('last_name', this.form.last_name);
            formData.append('suffix', this.form.last_name);
            formData.append('birthdate', this.form.birthdate);
            formData.append('sex', this.form.sex);
            formData.append('religion', this.form.religion);
            formData.append('address', this.form.address);
            formData.append('civil_status', this.form.civil_status);
            formData.append('father', this.form.father);
            formData.append('mother', this.form.mother);
            formData.append('spouse', this.form.spouse);
            formData.append('spouse_address', this.form.spouse_address);
            formData.append('contact_no', this.form.contact_no);
            formData.append('e_name', this.form.e_name);
            formData.append('e_contact', this.form.e_contact);
            formData.append('e_address', this.form.e_address);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updatePatient({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'patients' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addPatient(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Patient successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'patients' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'patients' });

          }

        },
    }
</script>
