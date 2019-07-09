<template>
    <div class="print">
      <header id="header" class="header header-plain">
          <img class="hospital-logo" src="/img/hospital_logo.png">
          <h2>Gaviola Medical Hospital</h2>
          <div class="title">STATEMENT OF ACCOUNT</div>
          <div class="patient-details">
              <div class="col-md-6">
                  <div class="group">
                    <div class="label">Patient Name:</div>
                    <div class="value">{{allBillingReports.patient.full_name_plain}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Address:</div>
                    <div class="value">{{allBillingReports.patient.address}}</div>
                  </div>
                   <div class="group">
                    <div class="label">Attending Physician:</div>
                    <div class="value">{{allBillingReports.patientRecord.physician.full_name}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Room:</div>
                    <div class="value">{{allBillingReports.patientRecord.current_room ? allBillingReports.patientRecord.current_room.room_with_type : ''}}</div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="group">
                    <div class="label">Case No:</div>
                    <div class="value">{{allBillingReports.patient.case_no}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Final Diagnoses:</div>
                    <div class="value">{{allBillingReports.patientRecord.current_diagnose ? allBillingReports.patientRecord.current_diagnose.diagnose_name : ''}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Date of Adminission/Time:</div>
                    <div class="value">{{allBillingReports.patientRecord.admit_and_check_date + '/' + allBillingReports.patientRecord.admit_and_check_time}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Date of Discharge/Time:</div>
                    <div class="value">{{
                    allBillingReports.patientRecord.discharged_date ? allBillingReports.patientRecord.discharged_date : '' 
                    + '/' 
                    + allBillingReports.patientRecord.discharged_time ? allBillingReports.patientRecord.discharged_time : null}}</div>
                  </div>
                  
              </div>
          </div>
      </header><!-- /header -->
      <div class="content main-billing">
        <table class="table">
          <thead>
            <tr>
              <th>Particulars</th>
              <th>Actual Bill</th>
              <th>VAT exempt</th>
              <th>Sr. Citizen</th>
              <th>HMO/Phic</th>
              <th>Excess</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="item in allBillingReports.billings">
                <td>{{item.type_of_charge.name}}</td>
                <td>{{formatPrice(item.total)}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{formatPrice(item.total)}}</td>
              </tr>
              <tr v-for="item in allBillingReports.patientRecord.patient_discounts">
                <td>{{item.discount ? item.discount.name : ''}}</td>
                <td></td>
                <td></td>
                <td>{{(item.amount * 100) + '%'}}</td>
                <td></td>
                <td></td>
              </tr>
              <tr v-for="item in allBillingReports.patientRecord.patient_insurances">
                <td>{{item.insurance ? item.insurance.name : ''}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{formatPrice(item.amount)}}</td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" class="bill-right">Total</td>
                <td>{{allBillingReports.totalBill}}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" class="bill-right">Discount</td>
                <td>{{allBillingReports.totalDiscount}}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" class="bill-right">HMO</td>
                <td>{{allBillingReports.totalHMO}}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" class="bill-right">Grand Total</td>
                <td class="bill-right">{{allBillingReports.grandTotal}}</td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script>

  import { mapGetters, mapActions } from 'vuex';

  export default {

      components: {},

      props: {},

      data() {
          return {
              // reports: []
          }
      },

      mounted() {
          // this.fetchBillingReports(this.$route.params.patient_record_id);

          // console.log(this.allBillingReports);
      },

      computed: {
        ...mapGetters([
              'allBillingReports', 
            ]),
      },

      created() {
          this.fetchBillingReports(this.$route.params.patient_record_id);
      },

      methods: {
        ...mapActions([
            'fetchBillingReports',
          ]),

        formatPrice(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
      },
  }
</script>
