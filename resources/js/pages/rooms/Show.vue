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
                    <b-card title="Room Information" v-if="!loading">
                      <b-row>
                        
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Name" label-for="input-default">
                              <div class="form-control form-group-value">{{ room.name }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Description" label-for="input-default">
                              <div class="form-control form-group-value">{{ room.description }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Capacity" label-for="input-default">
                              <div class="form-control form-group-value">{{ room.capacity }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Room" label-for="input-default">
                              <div class="form-control form-group-value">{{ room.type_of_room.name }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Floor" label-for="input-default">
                              <div class="form-control form-group-value">{{ room.floor.name }}</div>
                            </b-form-group>
                        </b-col>

                      </b-row>
                      <b-button type="button" variant="primary" @click="cancel">Cancel</b-button>
                    </b-card>
                </div>
              </div>
           </div>
        </div>
    </Layout>
</template>

<script>
    
    import Layout from '../../components/Layout';
    import { mapActions, mapGetters } from 'vuex';
    import { FulfillingBouncingCircleSpinner } from 'epic-spinners';

    export default {
        components: {
            Layout,
            FulfillingBouncingCircleSpinner
        },

        props: {

        },

        data() {
            return {
                room: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allRooms']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const room = this.showRoomById(this.$route.params.id);

                room.then(response => {

                    this.loading = false;

                    this.room = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showRoomById']),

          cancel() {

            this.$router.push({ name: 'rooms' });

          }

        },
    }
</script>
