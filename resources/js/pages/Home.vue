<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard Page</h1>
                  
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard Page</a></li>
                </ul>
            </div>
          <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Patient</h4>
              <p><b>{{ allDashboard.patientTotal }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h4>In Patient</h4>
              <p><b>{{ allDashboard.inPatientTotal }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Rooms</h4>
              <p><b>{{ allDashboard.roomTotal }}</b></p>
            </div>
          </div>
        </div>
      </div>
    </Layout>
</template>

<script>

    import Layout from '../components/Layout';
    import { mapGetters, mapActions } from 'vuex';

    export default {
        components: {
            Layout
        },

        props: {},

        data() {
            return {}
        },

        mounted() {
            this.fetchDashboard();
        },

        computed: {
            ...mapGetters(['allDashboard']),
        },

        methods: {
            ...mapActions(['fetchDashboard']),
        },
    }
</script>
