<template>
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
        <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
          <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      stacked="md"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
      :busy="items <= 0"
    >
      <div slot="table-busy" class="text-center">
        <b-spinner class="align-middle"></b-spinner>
        <strong>Loading...</strong>
      </div>

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
          :total-rows="totalRows"
          :per-page="perPage"
          class="my-0"
        ></b-pagination>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

    import moment from 'moment';

    export default {

        components: {},

        props: ['items'],

        data() {
            return {
              // items: [{}],
              fields: [
              { key: 'bot_no', label: 'Bot No.', sortable: true, sortDirection: 'desc' },
              { key: 'kind_of_solutions', label: 'Kind of Solutions', sortable: true, sortDirection: 'desc' },
                { key: 'gtss', label: 'GTSS', sortable: true, sortDirection: 'desc' },
                { key: 'remarks', label: 'Remarks', sortable: true, sortDirection: 'desc' },
                { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc', class: 'text-right' },
                { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc', class: 'text-right' },
              ],
              totalRows: 1,
              currentPage: 1,
              perPage: 5,
              pageOptions: [5, 10, 15],
              sortBy: null,
              sortDesc: false,
              sortDirection: 'asc',
              filter: null,
            }
        },

        mounted() {

            // Set the initial number of items
            this.totalRows = this.items.length;

        },

        computed: {

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

          onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
          },

        },
    }
</script>
