<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Type Of Charges Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Type Of Charges Page</a></li>
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
                              label="Name:"
                              label-for="name"
                            >
                              <b-form-input
                                v-model="form.name"
                                type="text"
                                placeholder="Enter Name"
                              />
                            </b-form-group>

                            <b-form-group
                                label="Group Of charge:"
                                label-for="groupOfCharge"
                            >
                                <multiselect 
                                  v-model="form.group_of_charge" 
                                  placeholder="Select Group Of Charge" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allGroupOfCharges" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                                label="Type:"
                                label-for="type"
                            >
                                <multiselect 
                                  v-model="form.category" 
                                  placeholder="Select Type" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allTypes" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                              label="price:"
                              label-for="price"
                            >
                              <b-form-input
                                v-model="form.price"
                                type="number"
                                placeholder="Enter price"
                              />
                            </b-form-group>

                            <b-form-checkbox
                                v-model="form.is_default"
                                name="is_default"
                                :value="1"
                                :unchecked-value="0"
                                class="form-group"
                            >
                              Default 
                            </b-form-checkbox>

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
                  name: '',
                  price: 0.00,
                  group_of_charge: null,
                  category: null,
                  is_default: 0,
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchTypeOfCharges();
            this.fetchTypes();
            this.fetchGroupOfCharges();

            if(this.$route.params.id) {
                this.loading = true;
                const typeOfCharge = this.showTypeOfChargeById(this.$route.params.id);
                typeOfCharge.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {

            ...mapGetters(['allTypeOfCharges', 'allTypes', 'allGroupOfCharges']),

        },

        methods: {

          ...mapActions([
            'addTypeOfCharge', 
            'updateTypeOfCharge', 
            'showTypeOfChargeById', 
            'fetchTypeOfCharges',
            'fetchTypes',
            'fetchGroupOfCharges'
          ]),

          onSubmit(event) {

            event.preventDefault();

            this.loadSubmit = true;

            let formData = new FormData();

            formData.append('name', this.form.name);
            formData.append('price', this.form.price);
            formData.append('is_default', this.form.is_default);
            formData.append('group_of_charge_id', this.form.group_of_charge ? this.form.group_of_charge.id : 0);
            formData.append('type_id', this.form.category ? this.form.category.id : 0);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateTypeOfCharge({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Type of charge successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'typeOfCharges' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addTypeOfCharge(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Type of charge successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'typeOfCharges' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'typeOfCharges' });

          }

        },
    }
</script>
