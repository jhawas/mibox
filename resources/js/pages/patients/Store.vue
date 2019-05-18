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

                    <div class="bs-component" v-if="errors.length > 0">
                      <div class="alert alert-dismissible alert-danger">
                        
                        <button class="close" type="button" data-dismiss="alert">×</button>
                        
                        <div v-for="error in errors">{{ error }}</div>

                      </div>
                    </div>

                    <b-form @submit="onSubmit">
                      <b-row>
                         <b-col col lg="6">
                            <b-form-group
                              id="input-group-first-name"
                              label="First Name:"
                              label-for="first_name"
                            >
                              <b-form-input
                                id="first_name"
                                v-model="form.first_name"
                                type="text"
                                placeholder="Enter First Name"
                              />
                            </b-form-group>
                            <b-form-group
                              id="input-group-middle-name"
                              label="Middle Name:"
                              label-for="middle_name"
                            >
                              <b-form-input
                                id="middle_name"
                                v-model="form.middle_name"
                                type="text"
                                placeholder="Enter Middle Name"
                              />
                            </b-form-group>
                            <b-form-group
                              id="input-group-last-name"
                              label="Last Name:"
                              label-for="last_name"
                            >
                              <b-form-input
                                id="last_name"
                                v-model="form.last_name"
                                type="text"
                                placeholder="Enter Last Name"
                              />
                            </b-form-group>
                         </b-col>
                         <b-col col lg="6">
                            
                         </b-col>
                      </b-row>
                      <b-button type="submit" variant="primary">Save</b-button>
                      <b-button type="button" variant="primary" @click="cancel">Cancel</b-button>
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

    import { mapActions } from 'vuex';
    
    export default {
        components: {
            Layout
        },

        props: {
            props: ['id'],
        },

        data() {
            return {
                form: {
                  first_name: '',
                  middle_name: '',
                  last_name: '',
                },
                errors: [],
            }
        },

        mounted() {

            if(this.$route.params.id) {
                const patient = this.showPatientById(this.$route.params.id);
                patient.then(response => {
                      this.form = response.data;
                });
            }
            
        },

        computed: {
          
        },

        methods: {

          ...mapActions(['addPatient', 'updatePatient', 'showPatientById']),

          onSubmit(event) {


            event.preventDefault();

            let formData = new FormData();

            formData.append('first_name', this.form.first_name);
            formData.append('middle_name', this.form.middle_name);
            formData.append('last_name', this.form.last_name);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updatePatient({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      toastr.success('Patient successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'patients' });
                  }
              });

            } else {
             
              const response = this.addPatient(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      toastr.success('Patient successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'patients' });
                  }

              }).catch(error => {

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
