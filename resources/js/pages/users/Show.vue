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
                    <b-card title="User Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="First Name" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.first_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Middle Name" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.middle_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Last Name" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.last_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Suffix" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.suffix }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Sex" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.sex }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Specialty" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.specialty }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Contact No." label-for="input-default">
                              <div class="form-control form-group-value">{{ user.contact_no }}</div>
                            </b-form-group>
                        </b-col>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Email" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.email }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Username" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.username }}</div>
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
    import { mapActions } from 'vuex';
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
                user: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
          
        },

        created() {

            if(this.$route.params.id) {

                this.loading = true;

                const patient = this.showUserById(this.$route.params.id);
                patient.then(response => {
                      this.user = response.data;
                      this.loading = false;
                });
            }

        },

        methods: {

          ...mapActions(['showUserById']),

          cancel() {

            this.$router.push({ name: 'users' });

          }

        },
    }
</script>
