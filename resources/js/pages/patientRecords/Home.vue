<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> In Patient Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">In Patient Page</a></li>
                </ul>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                    <b-container fluid>
                      <!-- User Interface controls -->
                      <b-row>
                        <b-col md="6" class="my-1">
                          <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
                            <b-input-group>
                              <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
                              <b-input-group-append>
                                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                              </b-input-group-append>
                            </b-input-group>
                          </b-form-group>
                        </b-col>

                        <b-col md="6" class="my-1">
                          <b-form-group label-cols-sm="3" label="Sort" class="mb-0">
                            <b-input-group>
                              <b-form-select v-model="sortBy" :options="sortOptions">
                                <option slot="first" :value="null">-- none --</option>
                              </b-form-select>
                              <div class="input-group-append">
                                <b-form-select v-model="sortDesc" :disabled="!sortBy">
                                  <option :value="false">Asc</option> <option :value="true">Desc</option>
                                </b-form-select>
                              </div>
                            </b-input-group>
                          </b-form-group>
                        </b-col>

                        <b-col md="6" class="my-1">
                          <b-form-group label-cols-sm="3" label="Add" class="mb-0">
                                <b-button @click="create">New</b-button>
                          </b-form-group>
                        </b-col>

                        <b-col md="6" class="my-1">
                          <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
                            <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <b-row>
                        <b-col md="6" class="my-1">
                          <b-form-group label-cols-sm="3" label="Discharged" class="mb-0">
                            <b-form-checkbox
                              v-model="discharged"
                              name="discharged"
                              :value="1"
                              :unchecked-value="0"
                              class="form-group"
                              @change="onDischargeStatusChanged"
                            >
                            </b-form-checkbox>
                          </b-form-group>
                        </b-col>
                      </b-row>
                      <!-- Main table element -->
                      <b-table
                        show-empty
                        stacked="md"
                        :items="allPatientRecords"
                        :fields="fields"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"
                        @filtered="onFiltered"
                        :busy="allPatientRecords <= 0"
                      >
                        <div slot="table-busy" class="text-center">
                          <b-spinner class="align-middle"></b-spinner>
                          <strong>Loading...</strong>
                        </div>

                        <template slot="patient" slot-scope="row" right>
                            {{row.item.patient ? row.item.patient.full_name : null }}
                        </template>

                        <template slot="type_of_record" slot-scope="row" right>
                            {{row.item.type_of_record ? row.item.type_of_record.name : null }}
                        </template>

                        <template slot="for_discharge" slot-scope="row" right>
                           <i :class="displayStatus(row.item.for_discharge)" aria-hidden="true"></i>
                        </template>

                        <template slot="actions" slot-scope="row" right>
                            <b-button>
                                <i class="fa fa-eye" @click="show(row.item)" aria-hidden="true"></i>
                            </b-button>
                            
                            <b-button @click="update(row.item)">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </b-button>
                            <b-button @click="destroy(row.item)">
                                <i class="fa fa-eraser" aria-hidden="true"></i>
                            </b-button>
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
              // items: [{}],
              fields: [
                { key: 'patient', label: 'Patient', sortable: true, sortDirection: 'desc' },
                { key: 'admit_and_check_date', label: 'Date', sortable: true, sortDirection: 'desc' },
                { key: 'admit_and_check_time', label: 'Time', sortable: true, sortDirection: 'desc' },
                { key: 'for_discharge', label: 'For Discharge', class: 'text-center' },
                { key: 'actions', label: 'Actions', class: 'text-right' }
              ],
              totalRows: 1,
              currentPage: 1,
              perPage: 5,
              pageOptions: [5, 10, 15],
              sortBy: 'admit_and_check_date',
              sortDesc: true,
              sortDirection: 'desc',
              filter: null,
              discharged: 0,
            }
        },

        mounted() {

            // Set the initial number of items
            this.totalRows = this.allPatientRecords.length;

        },

        computed: {

          ...mapGetters(['allPatientRecords']),

          rows() {
            return this.allPatientRecords.length;
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

            this.fetchPatientRecordsByDischarged(0);

        },

        methods: {

          ...mapActions(['fetchPatientRecords', 'deletePatientRecord', 'fetchPatientRecordsByDischarged']),

          onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
          },

          onDischargeStatusChanged(checked) {
              this.fetchPatientRecordsByDischarged(checked);
          },

          displayStatus(status) {
            return status ? 'fa fa-check' : 'fa fa-close'
          },

          create() {

            this.$router.push({ name: 'patientRecord-create' });

          },

          update(item) {

            this.$router.push({ name: 'patientRecord-create', params: { id: item.id } });

          },

          show(item) {

            this.$router.push({ name: 'patientRecord-show', params: { id: item.id } });

          },

          destroy(item) {

            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {

              if (willDelete) {

                  const response = this.deletePatientRecord(item.id);

                  response.then( response => {
                      console.log(response.data);
                      if(response.data.message === 'success') {

                          toastr.success('Record successfully deleted.', 'Message');
                          
                          this.$router.push({ name: 'patientRecords' });
                      }
                  });

              }

            });

          },

        },
    }
</script>
