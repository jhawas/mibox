<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Nurse Note Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Nurse Note Page</a></li>
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
                    <b-card title="Nurse Note Information" v-if="!loading">
                      <b-row>
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Patient" label-for="input-default">
                              <div class="form-control form-group-value">{{ nurseNote.patient_record.full_name }}</div>
                            </b-form-group>
                        </b-col>
                        
                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Date" label-for="input-default">
                              <div class="form-control form-group-value">{{ nurseNote.date }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Time" label-for="input-default">
                              <div class="form-control form-group-value">{{ nurseNote.time }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Focus" label-for="input-default">
                              <div class="form-control form-group-value">{{ nurseNote.focus }}</div>
                            </b-form-group>
                        </b-col>

                        <b-col col md="6">
                            <b-form-group label-cols="4" label-cols-lg="2" label="Action Response" label-for="input-default">
                              <div class="form-control form-group-value">{{ nurseNote.action_response }}</div>
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
                nurseNote: {},
                loading: false,
            }
        },

        mounted() {

        },

        computed: {
            ...mapGetters(['allNurseNotes']),
        },

        created() {
            if(this.$route.params.id) {

                this.loading = true;

                const nurseNote = this.showNurseNoteById(this.$route.params.id);

                nurseNote.then(response => {

                    this.loading = false;

                    this.nurseNote = response.data;

                });
            }

        },

        methods: {

          ...mapActions(['showNurseNoteById']),

          cancel() {

            this.$router.push({ name: 'nurseNotes' });

          }

        },
    }
</script>
