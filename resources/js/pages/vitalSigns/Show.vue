<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Vital Sign Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Vital Sign Page</a></li>
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
                    <b-card title="Vital Sign Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="3" label="Patient" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.patient_record.full_name }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Date" label-for="input-default">
                                  <div class="form-control form-group-value">{{ vitalSign.date }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Time" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.time }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="BP (mm/hg)" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.bp }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="T (°C)" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.t }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="P (bit/minute)" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.p }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="R (cycle/minute)" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.r }}</div>
                            </b-form-group>

                        </b-col>
                        
                        <b-col col md="6">
                            <legend>Intake</legend>
                            
                            <b-form-group label-cols="4" label-cols-lg="3" label="Oral" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.intake_oral }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="I.V." label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.intake_iv }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="N.G." label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.intake_ng }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Total" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.total_intake }}</div>
                            </b-form-group>

                            <legend>Output</legend>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Urine" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.output_urine }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Stool" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.output_stool }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Emesis" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.output_emesis }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="N.G." label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.output_ng }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="3" label="Total" label-for="input-default">
                              <div class="form-control form-group-value">{{ vitalSign.total_output }}</div>
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
                vitalSign: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allVitalSigns']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const vitalSign = this.showVitalSignById(this.$route.params.id);

                vitalSign.then(response => {

                    this.loading = false;

                    this.vitalSign = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showVitalSignById']),

          cancel() {

            this.$router.push({ name: 'vitalSigns' });

          }

        },
    }
</script>
