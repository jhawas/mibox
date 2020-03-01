<template>
    <div class="print">
      <header id="header" class="header header-plain">
          <img class="hospital-logo" src="/img/hospital_logo.png">
          <h2>Gaviola Medical Hospital</h2>
          <div class="title">Patient List</div>
          <div class="date">{{ `${displayDate($route.params.startDate)} - ${displayDate($route.params.end)}` }}</div>
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
              <tr v-for="(item, index) in allReports" :key="index">
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
  import 'moment-range';

  export default {

      components: {},

      props: {},

      data() {
          return {}
      },

      mounted() {

      },

      computed: {

        ...mapGetters([
              'allReports',
            ]),
      },

      created() {
          this.fetchReports({ start: this.$route.params.startDate, end: this.$route.params.endDate});
          var range = moment().range(this.$route.params.startDate, this.$route.params.endDate);
          console.log(range.toString());
      },

      methods: {
        ...mapActions([
            'fetchReports',
          ]),

        displayDate(date) {
            return moment(date).format('MMM D, YYYY');
        },

        getAge(date) {
              return moment().diff(date, 'years');
          },
      },
  }
</script>
