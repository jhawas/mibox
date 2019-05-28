<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Type Of Laboratory Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Type Of Laboratory Page</a></li>
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
                    <b-card title="Type Of Laboratory Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Name" label-for="input-default">
                              <div class="form-control form-group-value">{{ typeOfLaboratory.name }}</div>
                            </b-form-group>
                            <b-form-group label-cols="4" label-cols-lg="2" label="Price" label-for="input-default">
                              <div class="form-control form-group-value">{{ typeOfLaboratory.price }}</div>
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
                typeOfLaboratory: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allTypeOfLaboratories']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const typeOfLaboratory = this.showTypeOfLaboratoryById(this.$route.params.id);

                typeOfLaboratory.then(response => {

                    this.loading = false;

                    this.typeOfLaboratory = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showTypeOfLaboratoryById']),

          cancel() {

            this.$router.push({ name: 'typeOfLaboratories' });

          }

        },
    }
</script>
