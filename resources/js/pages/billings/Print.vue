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
                    <div class="value">{{allBillingReports.patient ? allBillingReports.patient.full_name_plain : null}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Age:</div>
                    <div class="value">{{allBillingReports.patient ? getAge(allBillingReports.patient.birthdate) : null}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Address:</div>
                    <div class="value">{{allBillingReports.patient ? allBillingReports.patient.address : null}}</div>
                  </div>
                   <div class="group">
                    <div class="label">Attending Physician:</div>
                    <div class="value">{{allBillingReports.patientRecord ? allBillingReports.patientRecord.physician.full_name : null}}</div>
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
                    <div class="value">{{allBillingReports.patientRecord.current_diagnose &&allBillingReports.patientRecord.current_diagnose.description }}</div>
                  </div>
                  <div class="group">
                    <div class="label">Case Rate:</div>
                    <div class="value">{{allBillingReports.patientRecord.current_diagnose && allBillingReports.patientRecord.current_diagnose.diagnose_name}}</div>
                  </div>
                  <div class="group">
                    <div class="label">Date of Adminission/Time:</div>
                    <!-- <div class="value">{{allBillingReports.patientRecord.admit_and_check_date + '/' + allBillingReports.patientRecord.admit_and_check_time}}</div> -->
                    <div class="value">{{ admissionDatetime(allBillingReports.patientRecord) }}</div>
                  </div>
                  <div class="group">
                    <div class="label">Date of Discharge/Time:</div>
                    <!-- <div class="value">{{
                    allBillingReports.patientRecord.discharged_date ? allBillingReports.patientRecord.discharged_date : '' 
                    + '/' 
                    + allBillingReports.patientRecord.discharged_time ? allBillingReports.patientRecord.discharged_time : null}}</div> -->
                    <div class="value">{{ checkDischargeDatetime(allBillingReports.patientRecord) }}</div>
                  </div>
                  
              </div>
          </div>
      </header><!-- /header -->
      <div class="content main-billing">
          <div class="summary">
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
                    <tr v-for="item in allBillingReports.withoutGroupBill">
                      <td>{{item.type_of_charge.name}}</td>
                      <td class="align-right">{{formatPrice(item.total)}}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="align-right">{{formatPrice(item.total)}}</td>
                    </tr>
                    <tr>
                      <td>Laboratory</td>
                      <td class="align-right">{{formatPrice(allBillingReports.laboratoryGroupBillTotal)}}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="align-right">{{formatPrice(allBillingReports.laboratoryGroupBillTotal)}}</td>
                    </tr>
                    <tr>
                      <td>Medicine</td>
                      <td class="align-right">{{formatPrice(allBillingReports.medicineGroupBillTotal)}}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="align-right">{{formatPrice(allBillingReports.medicineGroupBillTotal)}}</td>
                    </tr>
                    <tr>
                      <td>Supplies</td>
                      <td class="align-right">{{formatPrice(allBillingReports.suppliesGroupBillTotal)}}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="align-right">{{formatPrice(allBillingReports.suppliesGroupBillTotal)}}</td>
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
                      <td class="align-right">{{formatPrice(item.amount)}}</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" class="bill-right">Total Bill</td>
                      <td class="align-right">{{allBillingReports.totalBill}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" class="bill-right">Specialty Fee</td>
                      <td class="align-right">{{allBillingReports.specialtyFeeString}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" class="bill-right">Discount</td>
                      <td class="align-right">{{allBillingReports.totalDiscount}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" class="bill-right">Phic</td>
                      <td class="align-right">{{allBillingReports.totalPhic}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" class="bill-right">HMO</td>
                      <td class="align-right">{{allBillingReports.totalHMO}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" class="bill-right">Grand Total</td>
                      <td class="bill-right align-right">{{allBillingReports.grandTotal}}</td>
                    </tr>
                </tbody>
              </table>
          </div>

          <div class="breakdown-content">
              <div class="breakdown">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Medicine</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in allBillingReports.medicineGroupBill">
                          <td>{{item.type_of_charge.name}}</td>
                          <td>{{item.quantity_and_days}}</td>
                          <td class="align-right">{{item.amount}}</td>
                          <td class="align-right">{{formatPrice(item.total)}}</td>
                        </tr>
                    </tbody>
                  </table>
              </div>
              <div class="breakdown">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Supplies</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in allBillingReports.suppliesGroupBill">
                          <td>{{item.type_of_charge.name}}</td>
                          <td>{{item.quantity_and_days}}</td>
                          <td class="align-right">{{item.amount}}</td>
                          <td class="align-right">{{formatPrice(item.total)}}</td>
                        </tr>
                    </tbody>
                  </table>
              </div>
              <div class="breakdown">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Laboratory</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in allBillingReports.laboratoryGroupBill">
                          <td>{{item.type_of_charge.name}}</td>
                          <td>{{item.quantity_and_days}}</td>
                          <td class="align-right">{{item.amount}}</td>
                          <td class="align-right">{{formatPrice(item.total)}}</td>
                        </tr>
                    </tbody>
                  </table>
              </div>
          </div>

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
              currentDate: moment().format('YYYY-MM-DD'),
              currentTime: moment().format('hh:mm a')
          }
      },

      mounted() {
          // this.fetchBillingReports(this.$route.params.patient_record_id);

          // console.log(this.allBillingReports);
          console.log('current', this.currentTime, this.currentDate);
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
        },

        getAge(date) {
              return moment().diff(date, 'years');
        },

        checkDischargeDatetime(data) {
            if(data.discharged_date != null && data.discharged_time != null) {
                return moment(data.discharged_date).format('YYYY-MM-DD') + '/' + moment(data.discharged_time).format('hh:mm a');
            } else {
                return this.currentDate + '/' + this.currentTime;
            }
        },
 
        admissionDatetime(data) {
            return moment(data.admit_and_check_date).format('YYYY-MM-DD') + '/' + data.admission_time;
        }
      },
  }
</script>
