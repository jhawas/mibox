<template>
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-title">
            Insurance
        </div>
        <div class="tile-body">
            <div>
              <b-table
                :items="items"
                :fields="fields"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
              >
                
                <template slot="insurance" slot-scope="row">
                    {{ row.value.name }}
                </template>

                <template slot="amount" slot-scope="row">
                    {{ row.value }}
                </template>

                <template slot="actions" slot-scope="row" right>
                        
                    <b-button @click="update(row.item)" v-if="hasAccess('update-patientInsurance')">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </b-button>
                    <b-button @click="destroy(row.item)" v-if="hasAccess('delete-patientInsurance')">
                        <i class="fa fa-eraser" aria-hidden="true"></i>
                    </b-button>

                </template>

              </b-table>
            </div>
        </div>
      </div>
    </div>
</template>

<script>

    import toastr from 'toastr';

    import swal from 'sweetalert';

    import { mapGetters, mapActions } from 'vuex';

    export default {

        components: {},

        props: {
            items: null,
            billing: {},
        },

        data() {
            return {
              sortBy: null,
              sortDesc: false,
              fields: [
                { key: 'insurance', label: 'Name', sortable: true, sortDirection: 'desc' },
                { key: 'amount', label: 'Amount', sortable: true, sortDirection: 'desc' },
                { key: 'actions', label: 'Actions', class: 'text-right' }
              ],
            }
        },

        mounted() {

        },

        computed: {

          ...mapGetters(['hasAccess']),

        },

        created() {

        },

        methods: {

          ...mapActions(['deletePatientInsurance']),

          update(item) {

            this.$router.push({ name: 'patientInsurance-create', params: { id: item.id } });

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

                  const response = this.deletePatientInsurance(item.id);

                  response.then( response => {
                      console.log(response.data);
                      if(response.data.message === 'success') {

                          toastr.success('Insurance successfully deleted.', 'Message');
                          
                          this.$router.push({ name: 'billings' });
                      }
                  });

              }

            });

          },

        },
    }
</script>
