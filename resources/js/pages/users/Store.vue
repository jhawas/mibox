<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> User Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">User Page</a></li>
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

                            <b-form-group
                              id="input-group-suffix"
                              label="Suffix:"
                              label-for="suffix"
                            >
                              <b-form-input
                                id="suffix"
                                v-model="form.suffix"
                                type="text"
                                placeholder="Enter Suffix"
                              />
                            </b-form-group>

                            <b-form-group
                              id="input-group-birthdate"
                              label="birthdate:"
                              label-for="birthdate"
                            >
                              <b-form-input
                                id="birthdate"
                                v-model="form.birthdate"
                                type="date"
                                placeholder="Enter birthdate"
                              />
                            </b-form-group>

                            <b-form-group
                              id="input-group-sex"
                              label="Sex:"
                              label-for="sex"
                            >
                              <b-form-select 
                                v-model="form.sex" 
                                :options="sex"
                              />
                            </b-form-group>

                            <b-form-group
                              id="input-group-specialty"
                              label="Specialty:"
                              label-for="specialty"
                            >
                              <b-form-input
                                id="specialty"
                                v-model="form.specialty"
                                type="text"
                                placeholder="Enter specialty"
                              />
                            </b-form-group>

                            <b-form-group
                              id="input-group-contact_no"
                              label="Contact No:"
                              label-for="contact_no"
                            >
                              <b-form-input
                                id="contact_no"
                                v-model="form.contact_no"
                                type="text"
                                placeholder="Enter contact no."
                              />
                            </b-form-group>

                         </b-col>
                         
                         <b-col col lg="6">
                              
                              <b-form-group
                                id="input-group-email"
                                label="Email:"
                                label-for="email"
                              >
                                <b-form-input
                                  id="email"
                                  v-model="form.email"
                                  type="email"
                                  placeholder="Enter email"
                                />
                              </b-form-group>

                              <b-form-group
                                id="input-group-username"
                                label="Username:"
                                label-for="username"
                              >
                                <b-form-input
                                  id="username"
                                  v-model="form.username"
                                  type="text"
                                  placeholder="Enter username"
                                />
                              </b-form-group>
              
                              <b-form-group
                                id="input-group-roles"
                                label="Roles:"
                                label-for="roles"
                              >
                                <multiselect 
                                  v-model="form.roles" 
                                  placeholder="Select Roles" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allRoles" 
                                  :multiple="true" 
                                  ></multiselect>

                              </b-form-group>

                              <b-form-group
                                id="input-group-password"
                                label="Password:"
                                label-for="password"
                              >
                                <b-form-input
                                  id="password"
                                  v-model="form.password"
                                  type="password"
                                  placeholder="Enter password"
                                />
                              </b-form-group>

                              <b-form-group
                                id="input-group-password_confirmation"
                                label="Confirm Password Confirmation:"
                                label-for="password_confirmation"
                              >
                                <b-form-input
                                  id="password_confirmation"
                                  v-model="form.password_confirmation"
                                  type="password"
                                  placeholder="Enter Password Confirmation"
                                />
                              </b-form-group>


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

    import Layout from '../../components/Layout';
    import toastr from 'toastr';
    import Multiselect from 'vue-multiselect';
    import { FulfillingBouncingCircleSpinner } from 'epic-spinners';

    import { mapActions, mapGetters } from 'vuex';
    
    export default {
        components: {
            Layout,
            Multiselect,
            FulfillingBouncingCircleSpinner
        },

        props: {

        },

        data() {
            return {
                sex: [
                    { value: '', text: 'Please select an option' },
                    { value: 'male', text: 'Male' },
                    { value: 'female', text: 'Female' },
                ],
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    suffix: '',
                    birthdate: '',
                    sex: '',
                    specialty: '',
                    contact_no: '',
                    email: '',
                    username: '',
                    password: '',
                    password_confirmation: '',
                    roles: [],
                },
                errors: [],
                loading: false,
                showAlert: false,
            }
        },

        mounted() {

            this.fetchRoles();
            
            if(this.$route.params.id) {
                this.loading = true;
                const user = this.showUserById(this.$route.params.id);
                user.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }

        },

        computed: {
            
            ...mapGetters(['allRoles']),

        },

        methods: {

          ...mapActions(['addUser', 'updateUser', 'showUserById', 'fetchRoles']),
          
          onSubmit(event) {

              event.preventDefault();

              let formData = new FormData();

              formData.append('first_name', this.form.first_name);
              formData.append('middle_name', this.form.middle_name);
              formData.append('last_name', this.form.last_name);
              formData.append('suffix', this.form.suffix);
              formData.append('birthdate', this.form.birthdate);
              formData.append('sex', this.form.sex);
              formData.append('specialty', this.form.specialty);
              formData.append('contact_no', this.form.contact_no);
              formData.append('email', this.form.email);
              formData.append('username', this.form.username);
              formData.append('password', this.form.password);
              formData.append('password_confirmation', this.form.password_confirmation);
              formData.append('roles', JSON.stringify(this.form.roles));
              
              
              if(this.$route.params.id > 0) {

                formData.append('_method', 'PUT');

                const response = this.updateUser({id: this.$route.params.id, formData: formData});

                response.then( response => {

                    if(response.data.message === 'success') {
                        
                        this.showAlert = false;

                        toastr.success('User successfully updated.', 'Message');
                        
                        this.$router.push({ name: 'users' });
                    }
                }).catch(error => {

                    this.showAlert = true;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
                });

              } else {

                const response = this.addUser(formData);
              
                response.then(response => {

                    console.log('user', response.data.message);

                    if(response.data.message === 'success') {

                        this.showAlert = false;

                        toastr.success('Users successfully saved.', 'Message');
                        
                        this.$router.push({ name: 'users' });
                    }

                }).catch(error => {

                    this.showAlert = true;

                    this.errors = Object.values(error.response.data.errors).flat();

                });

              }

          },

          cancel() {

            this.$router.push({ name: 'users' });

          }

        },
    }
</script>
