<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Intravenous Fluid Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Intravenous Fluid Page</a></li>
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
                    <b-card title="Intravenous Fluid Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">

                            <b-form-group label-cols="4" label-cols-lg="2" label="Patient" label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.patient_record.full_name }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Bot No." label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.bot_no }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Kind of Solution" label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.kind_of_solution }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Vol." label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.vol }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Remarks" label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.remarks }}</div>
                            </b-form-group>


                        </b-col>
                        
                        <b-col col md="6">

                            <b-form-group label-cols="4" label-cols-lg="2" label="Date" label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.date }}</div>
                            </b-form-group>

                            <b-form-group label-cols="4" label-cols-lg="2" label="Time" label-for="input-default">
                              <div class="form-control form-group-value">{{ intravenousFluid.time }}</div>
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
                intravenousFluid: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allIntravenousFluids']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const intravenousFluid = this.showIntravenousFluidById(this.$route.params.id);

                intravenousFluid.then(response => {

                    this.loading = false;

                    this.intravenousFluid = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showIntravenousFluidById']),

          cancel() {

            this.$router.push({ name: 'intravenousFluids' });

          }

        },
    }
</script>
