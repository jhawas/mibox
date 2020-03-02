<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Rooms Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Rooms Page</a></li>
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
                              id="input-group-description"
                              label="Description:"
                              label-for="description"
                            >
                              <b-form-textarea
                                id="textarea-description"
                                v-model="form.description"
                                placeholder="Enter description..."
                                rows="3"
                                max-rows="6"
                              ></b-form-textarea>
                            </b-form-group>

                            <b-form-group
                              id="input-group-capacity"
                              label="Capacity:"
                              label-for="capacity"
                            >
                              <b-form-input
                                id="capacity"
                                v-model="form.capacity"
                                type="number"
                                placeholder="Enter Name"
                              />
                            </b-form-group>

                            <b-form-group
                                id="input-group-typeOfRoom"
                                label="Type Of Room:"
                                label-for="typeOfRoom"
                              >
                                <multiselect 
                                  v-model="form.type_of_room" 
                                  placeholder="Select Type Of Room" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allTypeOfRooms" 
                                ></multiselect>

                            </b-form-group>

                            <b-form-group
                                id="input-group-floor"
                                label="Floor:"
                                label-for="floor"
                              >
                                <multiselect 
                                  v-model="form.floor" 
                                  placeholder="Select Floor" 
                                  label="name" 
                                  track-by="id" 
                                  :options="allFloors" 
                                ></multiselect>

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
            Multiselect,
        },

        props: {
            props: ['id'],
        },

        data() {
            return {
                form: {
                  name: '',
                  description: '',
                  capacity: 1,
                  floor: null,
                  type_of_room: null,
                },
                errors: [],
                loading: false,
                showAlert: false,
                loadSubmit: false,
            }
        },

        mounted() {

            this.fetchTypeOfRooms();
            this.fetchFloors();

            if(this.$route.params.id) {
                this.loading = true;
                const floor = this.showRoomById(this.$route.params.id);
                floor.then(response => {
                      this.form = response.data;
                      this.loading = false;
                });
            }
            
        },

        computed: {
            
            ...mapGetters(['allRooms', 'allTypeOfRooms', 'allFloors']),

        },

        methods: {

          ...mapActions(['addRoom', 'updateRoom', 'showRoomById', 'fetchTypeOfRooms', 'fetchFloors']),

          onSubmit(event) {

            this.loadSubmit = true;

            event.preventDefault();

            let formData = new FormData();

            formData.append('name', this.form.name);
            formData.append('description', this.form.description);
            formData.append('capacity', this.form.capacity);
            formData.append('type_of_room', this.form.type_of_room ? this.form.type_of_room.id : null);
            formData.append('floor', this.form.floor ? this.form.floor.id : null);

            if(this.$route.params.id > 0) {

              formData.append('_method', 'PUT');

              const response = this.updateRoom({id: this.$route.params.id, formData: formData});

              response.then( response => {
                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Room successfully updated.', 'Message');
                      
                      this.$router.push({ name: 'rooms' });
                  }
              }).catch(error => {

                    this.showAlert = true;

                    this.loadSubmit = false;

                    this.errors = Object.values(error.response.data.errors).flat();
                    
              });

            } else {
             
              const response = this.addRoom(formData);
              
              response.then(response => {

                  console.log(response.data);

                  if(response.data.message === 'success') {

                      this.showAlert = false;

                      this.loadSubmit = false;

                      toastr.success('Room successfully saved.', 'Message');
                      
                      this.$router.push({ name: 'rooms' });
                  }

              }).catch(error => {

                  this.showAlert = true;

                  this.loadSubmit = false;

                  this.errors = Object.values(error.response.data.errors).flat();

              });
              
            }

          },

          cancel() {

            this.$router.push({ name: 'rooms' });

          }

        },
    }
</script>
