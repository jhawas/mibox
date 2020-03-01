<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Report Page</h1>
                  <p>Generate Reports</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Report Page</a></li>
                </ul>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                    <b-container fluid>
                      <!-- User Interface controls -->
                      <b-row class="control-panel">
                        <b-col md="4" class="my-1">
                          <b-form-group label-cols-sm="3" label="Start Date" class="mb-0">
                            <b-input-group>
                              <b-form-input v-model="reportDate.start" type="date" @change="onDateChange('start')"></b-form-input>
                            </b-input-group>
                          </b-form-group>
                        </b-col>
                        <b-col md="4" class="my-1">
                          <b-form-group label-cols-sm="3" label="End Date" class="mb-0">
                            <b-input-group>
                               <b-form-input v-model="reportDate.end" type="date" @change="onDateChange('end')"></b-form-input>
                            </b-input-group>
                          </b-form-group>
                        </b-col>
                        <b-col md="4" class="my-1">
                          <b-button @click="onSearch" :disabled="disabledSearch">Search</b-button>
                          <b-button @click="print" :disabled="disabledSearch">Generate Report By Date</b-button>
                        </b-col>
                      </b-row>

                      <!-- Main table element -->
                      <b-table
                        show-empty
                        stacked="md"
                        :items="allReports"
                        :fields="fields"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"
                        @filtered="onFiltered"
                        :busy="allReports <= 0"
                      >
                        <div slot="table-busy" class="text-center">
                          <b-spinner class="align-middle"></b-spinner>
                          <strong>Loading...</strong>
                        </div>

                        <template slot="name" slot-scope="row" right>
                            {{ row.item.first_name + ' ' + row.item.middle_name + ' ' + row.item.last_name }}
                        </template>

                        <template slot="row-details" slot-scope="row">
                          <b-card>
                            <ul>
                              <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                            </ul>
                          </b-card>
                        </template>
                      </b-table>

                      <b-row>
                        <b-col md="6" class="my-1">
                          <b-pagination
                            v-model="currentPage"
                            :total-rows="rows"
                            :per-page="perPage"
                            class="my-0"
                          ></b-pagination>
                        </b-col>
                      </b-row>
                    </b-container>
                </div>
              </div>
           </div>
        </div>
    </Layout>
</template>

<script>

    import toastr from 'toastr';

    import swal from 'sweetalert';

    import Layout from '../../components/Layout';

    import moment from 'moment';

    import { mapGetters, mapActions } from 'vuex';

    export default {

        components: {
            Layout
        },

        props: {

        },

        data() {
            return {
              fields: [
                { key: 'case_no', label: 'Case No.', sortable: true, sortDirection: 'desc' },
                { key: 'name', label: 'Name', sortable: true, sortDirection: 'desc' },
                { key: 'birthdate', label: 'Age', sortable: true, sortDirection: 'desc', class: 'text-center' },
                { key: 'sex', label: 'Sex', sortable: true, sortDirection: 'desc', class: 'text-center' },
                { key: 'religion', label: 'Religion', sortable: true, sortDirection: 'desc', class: 'text-center' },
                { key: 'civil_status', label: 'Civil Status', sortable: true, sortDirection: 'desc', class: 'text-center' },
              ],
              totalRows: 1,
              currentPage: 1,
              perPage: 5,
              pageOptions: [5, 10, 15],
              sortBy: null,
              sortDesc: false,
              sortDirection: 'asc',
              filter: null,
              reportDate: {
                  start: moment().format('YYYY-MM-DD'),
                  end: moment().format('YYYY-MM-DD')
              },
              disabledSearch: false,
            }
        },

        mounted() {

            // Set the initial number of items
            // this.totalRows = this.allDiagnoses.length;

            console.log('mounted');

        },

        computed: {

          ...mapGetters(['allReports', 'hasAccess']),

          rows() {
            return this.allReports.length;
          },

          sortOptions() {
            // Create an options list from our fields
            return this.fields
              .filter(f => f.sortable)
              .map(f => {
                return { text: f.label, value: f.key }
              });
          }

        },

        created() {

        },

        methods: {

          ...mapActions(['fetchReports']),

          onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
          },

          onSearch() {
                this.fetchReports({ start: this.reportDate.start, end: this.reportDate.end });
          },

          onDateChange(type) {

                var start = moment(this.reportDate.start);
                var end = moment(this.reportDate.end);

                var difference = end.diff(start, 'days');

                if(difference < 0) {
                    this.disabledSearch = true;
                } else {
                    this.disabledSearch = false;
                }
          },

          print() {

              let routeData = this.$router.resolve({
                  name: 'patient-report-date',
                  params: { startDate: this.reportDate.start, endDate: this.reportDate.end }
              });
              window.open(routeData.href, '_blank');

          },
        },
    }
</script>
