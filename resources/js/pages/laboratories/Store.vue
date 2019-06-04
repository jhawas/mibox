<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Laboratory Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Laboratory Page</a></li>
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
                                label="Laboratory:"
                                label-for="laboratory"
                            >
                                <multiselect 
                                  v-model="form.laboratory" 
                                  placeholder="Select Patient" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allTypeOfLaboratories" 
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

    import { mapActions, mapGetters } from 'vuex';
    
    export default {
        components: {
            Layout,
            FulfillingBouncingCircleSpinner,
            Multiselect
        },

        props: {
            props: ['id'],
        },

        data() {
            return {
                form: {
                  patient_record: '',
                  laboratory: '',
                  description: '',
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchAvailablePatientRecords();
            this.fetchTypeOfLaboratories();

            if(this.$route.params.id) {
                this.loading = true;
                const laboratory = this.showLaboratoryById(this.$route.params.id);
                laboratory.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters(['allAvailablePatientRecords', 'allTypeOfLaboratories']),

        },

        methods: {

          ...mapActions([
              'addLaboratory', 
              'updateLaboratory', 
              'showLaboratoryById', 
              'fetchAvailablePatientRecords',
              'fetchTypeOfLaboratories'
            ]),

          onSubmit(event) {

            event.preventDefault();

            this.loadSubmit = true;

            let formData = new FormData();

            formData.append('patient_record_id', this.form.patient_record ? this.form.patient_record.id : 0);
            formData.append('type_of_charge_id', this.form.laboratory ? this.form.laboratory.id : 0);
            formData.append('price', this.form.laboratory ? this.form.laboratory.price : 0);
            formData.append('description', this.form.description);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateLaboratory({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Laboratory successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'laboratories' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addLaboratory(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Laboratory successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'laboratories' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'laboratories' });

          }

        },
    }
</script>
