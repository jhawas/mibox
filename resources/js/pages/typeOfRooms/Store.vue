<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Type Of Rooms Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Type Of Rooms Page</a></li>
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
                              id="input-group-name"
                              label="Name:"
                              label-for="name"
                            >
                              <b-form-input
                                id="name"
                                v-model="form.name"
                                type="text"
                                placeholder="Enter Name"
                              />
                            </b-form-group>

                            <b-form-group
                              id="input-group-price"
                              label="price:"
                              label-for="price"
                            >
                              <b-form-input
                                id="price"
                                v-model="form.price"
                                type="number"
                                placeholder="Enter price"
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

    import { mapActions } from 'vuex';
    
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
                const typeOfRoom = this.showTypeOfRoomById(this.$route.params.id);
                typeOfRoom.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            

        },

        methods: {

          ...mapActions(['addTypeOfRoom', 'updateTypeOfRoom', 'showTypeOfRoomById']),

          onSubmit(event) {

            event.preventDefault();

            this.loadSubmit = true;

            let formData = new FormData();

            formData.append('name', this.form.name);
            formData.append('price', this.form.price);
            formData.append('parent', this.form.parent ? this.form.parent.id : null);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateTypeOfRoom({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Type of room successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'typeOfRooms' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addTypeOfRoom(formData);
              
              response.then(response => {

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Type of room successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'typeOfRooms' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'typeOfRooms' });

          }

        },
    }
</script>
