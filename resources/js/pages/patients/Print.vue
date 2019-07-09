<template>
    <div class="print">
      <header id="header" class="header header-plain">
          <img class="hospital-logo" src="/img/hospital_logo.png">
          <h2>Gaviola Medical Hospital</h2>
          <div class="title">Patient Master List</div>
      </header><!-- /header -->
      <div class="content main-billing">
        <table class="table">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Address</th>
              <th>Birthdate</th>
              <th>Age</th>
              <th>Diagnoses</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="item in allPatients">
                <td>{{ item.full_name_plain }}</td>
                <td>{{ item.address }}</td>
                <td>{{ item.birthdate }}</td>
                <td>{{ getAge(item.birthdate) }}</td>
                <td>{{ item.current_patient_records ? item.current_patient_records.current_diagnose.diagnose.name : '' }}</td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script>

  import { mapGetters, mapActions } from 'vuex';
  import moment from 'moment';

  export default {

      components: {},

      props: {},

      data() {
          return {
              // reports: []
          }
      },

      mounted() {
          this.fetchPatients();
      },

      computed: {
        ...mapGetters([
              'allPatients', 
            ]),
      },

      created() {
          // this.fetchBillingReports(this.$route.params.patient_record_id);
      },

      methods: {
        ...mapActions([
            'fetchPatients',
          ]),

        getAge(date) {
              return moment().diff(date, 'years');
          },
      },
  }
</script>
