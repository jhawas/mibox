<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> In & Out Patient Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#" @click="cancel">In & Out Patient Page</a></li>
                </ul>
            </div>
          <div class="row">
            <fulfilling-bouncing-circle-spinner
              :animation-duration="4000"
              :size="60"
              color="#009688"
              class="ibox-spinner"
              v-if="loading"
            />
            <div class="col-md-12" v-if="!loading">
              <div class="tile">
                <div class="tile-body">
                    <div>
                      <b-tabs content-class="mt-3" fill>
                        <b-tab title="Informtation" active>
                          <b-row>
                            <b-col col md="6">
                                <b-form-group label-cols="4" label-cols-lg="2" label="Name" label-for="input-default">
                                  <div class="form-control form-group-value">{{ patientRecord.name }}</div>
                                </b-form-group>
                            </b-col>
                          </b-row>
                        </b-tab>
                        <b-tab title="Diagnoses">
                          <p></p>
                        </b-tab>
                        <b-tab title="Nurse Note">
                          <p></p>
                        </b-tab>
                        <b-tab title="Medication And Treatment">
                          <p></p>
                        </b-tab>
                        <b-tab title="Vital Sign">
                          <p></p>
                        </b-tab>
                        <b-tab title="Intravenous Fluid">
                          <p></p>
                        </b-tab>
                        <b-tab title="Doctor's Order">
                          <p></p>
                        </b-tab>
                        <b-tab title="Laboratory">
                          <p></p>
                        </b-tab>
                        <b-tab title="Disabled" disabled>
                          <p></p>
                        </b-tab>
                      </b-tabs>
                    </div>
                </div>
              </div>
           </div>

           <div class="col-md-12" v-if="!loading">
              <div class="tile">
                <div class="tile-body">
                    test
                </div>
              </div>
           </div>
        </div>
         <b-button type="button" variant="secondary" @click="cancel">Back</b-button>
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
                patientRecord: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allPatientRecords']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const patientRecord = this.showPatientRecordById(this.$route.params.id);

                patientRecord.then(response => {

                    this.loading = false;

                    this.patientRecord = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showPatientRecordById']),

          cancel(event) {

            event.preventDefault();

            this.$router.push({ name: 'patientRecords' });

          }

        },
    }
</script>
