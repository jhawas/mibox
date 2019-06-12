<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Billing Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Billing Page</a></li>
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
                          <b-form-group label-cols-sm="3" label="Patient">
                            <multiselect 
                              v-model="billing.patient_record" 
                              placeholder="Select Patient" 
                              label="full_name" 
                              track-by="id" 
                              :options="allPatientRecords" 
                              @input="onChange"
                            ></multiselect>
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
                          <b-form-group label-cols-sm="3" label="Action" class="mb-0">
                                <b-button 
                                  @click="create" 
                                  :disabled="!billing.patient_record"
                                  v-if="hasAccess('create-billing')"
                                >Add Bill</b-button>
                                <b-button 
                                  @click="create" 
                                  :disabled="!billing.patient_record"
                                  v-if="hasAccess('create-patientInsurance')"
                                >Add Insurance</b-button>
                                <b-button 
                                  @click="create" 
                                  :disabled="!billing.patient_record"
                                  v-if="hasAccess('create-patientDiscount')"
                                >Add Discount</b-button>
                          </b-form-group>
                        </b-col>

                        <b-col md="6" class="my-1">
                          <b-form-group label-cols-sm="3" label="Print">
                                <b-button 
                                  @click="create" 
                                  :disabled="!billing.patient_record"
                                >Billing</b-button>
                          </b-form-group>
                        </b-col>
                      </b-row>

                      <!-- Main table element -->
                      <b-table
                        show-empty
                        stacked="md"
                        :items="allBillings"
                        :fields="fields"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"
                        @filtered="onFiltered"
                        :busy="allBillings <= 0"
                      >
                        <div slot="table-busy" class="text-center">
                          <b-spinner class="align-middle"></b-spinner>
                          <strong>Loading...</strong>
                        </div>

                        <template slot="type_of_charge" slot-scope="row">
                            {{ row.value ? row.value.name : null }}
                        </template>

                        <template slot="actions" slot-scope="row" right>
                            <b-button v-if="hasAccess('view-billing')">
                                <i class="fa fa-eye" @click="show(row.item)" aria-hidden="true"></i>
                            </b-button>
                            
                            <b-button @click="update(row.item)" v-if="hasAccess('update-billing')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </b-button>
                            <b-button @click="destroy(row.item)" v-if="hasAccess('delete-billing')">
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
                            :total-rows="totalRows"
                            :per-page="perPage"
                            class="my-0"
                          ></b-pagination>
                        </b-col>
                      </b-row>
                    </b-container>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="tile">
                <div class="tile-title">
                    Insurance
                </div>
                <div class="tile-body">
                    <div>
                      <b-table
                        :items="allBillings"
                        :fields="fields"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                      ></b-table>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="tile">
                <div class="tile-title">
                    Discount
                </div>
                <div class="tile-body">
                    <div>
                      <b-table
                        :items="allBillings"
                        :fields="fields"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                      ></b-table>
                    </div>
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

    import Multiselect from 'vue-multiselect';

    export default {

        components: {
            Layout,
            Multiselect
        },

        props: {

        },

        data() {
            return {
              billing: {},
              fields: [
                { key: 'patient_record_id', label: 'Record ID', sortable: true, sortDirection: 'desc' },
                { key: 'type_of_charge', label: 'Charge', sortable: true, sortDirection: 'desc' },
                { key: 'amount', label: 'Amount', sortable: true, sortDirection: 'desc' },
                { key: 'quantity_and_days', label: 'Quantity/Days', sortable: true, sortDirection: 'desc' },
                { key: 'total', label: 'Total', sortable: true, sortDirection: 'desc' },
                { key: 'actions', label: 'Actions', class: 'text-right' }
              ],
              totalRows: 1,
              currentPage: 1,
              perPage: 10,
              pageOptions: [5, 10, 15],
              sortBy: null,
              sortDesc: false,
              sortDirection: 'asc',
              filter: null,
            }
        },

        mounted() {

            this.billing = this.defaultBilling ? this.defaultBilling : {};

            this.fetchPatientRecords();

            // Set the initial number of items
            this.totalRows = this.allBillings.length;

        },

        computed: {

          ...mapGetters(['allBillings', 'allPatientRecords', 'defaultBilling', 'hasAccess']),

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

            // this.fetchBillings();
            if(this.defaultBilling.patient_record_id) {
                this.fetchBillingsByRecord(this.defaultBilling);
            }

        },

        methods: {

          ...mapActions([
            'fetchBillings', 
            'deleteBilling', 
            'fetchPatientRecords', 
            'fetchBillingsByRecord',
          ]),

          onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
          },

          onChange(value) {

              this.fetchBillingsByRecord(value ? value : 0);
          },

          create() {

            this.$router.push({ name: 'billing-create' });

          },

          update(item) {

            this.$router.push({ name: 'billing-create', params: { id: item.id } });

          },

          show(item) {

            this.$router.push({ 
              name: 'billing-show', 
              params: { id: item.id },
              props: { patient_record: this.billing.patient_record }
            });

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

                  const response = this.deleteBilling(item.id);

                  response.then( response => {
                      console.log(response.data);
                      if(response.data.message === 'success') {

                          toastr.success('Billing successfully deleted.', 'Message');
                          
                          this.$router.push({ name: 'billings' });
                      }
                  });

              }

            });

          },

        },
    }
</script>
