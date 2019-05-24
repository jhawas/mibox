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
                    <b-card title="Patient Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Default" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.first_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Default" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.middle_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Default" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.last_name }}</div>
                            </b-form-group>
                        </b-col>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Default" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.first_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Default" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.first_name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Default" label-for="input-default">
                              <div class="form-control form-group-value">{{ user.first_name }}</div>
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
                user: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allPatients']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const patient = this.showPatientById(this.$route.params.id);

                patient.then(response => {

                    this.loading = false;

                    this.user = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showPatientById']),

          cancel() {

            this.$router.push({ name: 'patients' });

          }

        },
    }
</script>
