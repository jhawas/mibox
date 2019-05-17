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
                                required
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
                                required
                                placeholder="Enter Last Name"
                              />
                            </b-form-group>
                            <!-- <b-form-group
                              id="input-group-1"
                              label="Email address:"
                              label-for="input-1"
                              description="We'll never share your email with anyone else."
                            >
                              <b-form-input
                                id="input-1"
                                v-model="form.email"
                                type="email"
                                required
                                placeholder="Enter email"
                              />
                            </b-form-group> -->
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
                    last_name: ''
                },
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

                      toastr.success('Patient successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'patients' });
                  }
              });

            } else {
             
              const response = this.addPatient(formData);
              
              response.then( response => {
                  if(response.data.message === 'success') {

                      toastr.success('Patient successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'patients' });
                  }
              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'patients' });

          }

        },
    }
</script>
