<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Doctor's Order Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Doctor's Order Page</a></li>
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
                    <b-card title="Doctor's Order Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            

                            <b-form-group label-cols="4" label-cols-lg="2" label="Patient" label-for="input-default">
                              <div class="form-control form-group-value">{{ doctorsOrder.patient_record.full_name }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Date" label-for="input-default">
                              <div class="form-control form-group-value">{{ doctorsOrder.date }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Orders" label-for="input-default">
                              <div class="form-control form-group-value">{{ doctorsOrder.orders }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Progress note" label-for="input-default">
                              <div class="form-control form-group-value">{{ doctorsOrder.progress_note }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Laboratories" label-for="input-default">
                              <div class="form-control form-group-value">
                                <span v-for="(laboratory, index) in stringToObject(doctorsOrder.laboratories)" :key="index">
                                  {{ laboratory.name + ', ' }}
                                </span>
                              </div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Time" label-for="input-default">
                              <div class="form-control form-group-value">{{ doctorsOrder.time }}</div>
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
                doctorsOrder: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allDoctorsOrders']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const doctorsOrder = this.showDoctorsOrderById(this.$route.params.id);

                doctorsOrder.then(response => {

                    this.loading = false;

                    this.doctorsOrder = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showDoctorsOrderById']),

          cancel() {

            this.$router.push({ name: 'doctorsOrders' });

          },

          stringToObject(value) {
              return JSON.parse(value);
          },

        },
    }
</script>
