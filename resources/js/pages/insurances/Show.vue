<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Insurance Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Insurance Page</a></li>
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
                    <b-card title="Discount Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Name" label-for="input-default">
                              <div class="form-control form-group-value">{{ insurance.name }}</div>
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
                insurance: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allInsurances']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const insurance = this.showInsuranceById(this.$route.params.id);

                insurance.then(response => {

                    this.loading = false;

                    this.insurance = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showInsuranceById']),

          cancel() {

            this.$router.push({ name: 'insurances' });

          }

        },
    }
</script>
