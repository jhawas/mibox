<template>
    <div>
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
          <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            <div>
              <p class="app-sidebar__user-name">{{ currentUserDisplayName }}</p>
              <p class="app-sidebar__user-designation">{{ displayUserRoles }}</p>
            </div>
          </div>
          <ul class="app-menu">
            <li>
                <router-link :to="{ name: 'home' }" class="app-menu__item">
                  <i class="app-menu__icon fa fa-dashboard"></i>
                  <span class="app-menu__label">Dashboard</span>
                </router-link>
              </li>
              <li v-if="hasAccess('view-user')">
                <router-link :to="{ name: 'users' }" class="app-menu__item">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">Users</span>
                </router-link>
              </li>
              <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                  <i class="app-menu__icon fa fa-th-list"></i>
                    <span class="app-menu__label">Manage Patient</span>
                  <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li v-if="hasAccess('view-patient')">
                    <router-link :to="{ name: 'patients' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Patient Information
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-patientRecord')">
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> In Patient
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-patientRoom')">
                    <router-link :to="{ name: 'patientRooms' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Room
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-nurseNote')">
                    <router-link :to="{ name: 'nurseNotes' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Nurses Notes
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-medicationAndTreatment')">
                    <router-link :to="{ name: 'medicationAndTreatments' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Medication and Treatments
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-vitalSign')">
                    <router-link :to="{ name: 'vitalSigns' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Vital Signs
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-intravenousFluid')">
                    <router-link :to="{ name: 'intravenousFluids' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Intravenous Fluids
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-doctorsOrder')">
                    <router-link :to="{ name: 'doctorsOrders' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Doctors Order
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-laboratory')">
                    <router-link :to="{ name: 'laboratories' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Laboratory
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-patientDiagnoses')">
                    <router-link :to="{ name: 'patientDiagnoses' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Diagnoses
                    </router-link>
                  </li>
                </ul>
              </li>
              <li v-if="hasAccess('view-billing')">
                <router-link :to="{ name: 'billings' }" class="app-menu__item">
                    <i class="app-menu__icon fa fa-money"></i>
                    <span class="app-menu__label">Billing</span>
                </router-link>
              </li>
              <li>
                <router-link :to="{ name: 'reports' }" class="app-menu__item">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Reports</span>
                </router-link>
              </li>
              <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                  <i class="app-menu__icon fa fa-th-list"></i>
                    <span class="app-menu__label">Manage Rooms</span>
                  <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li v-if="hasAccess('view-room')">
                    <router-link :to="{ name: 'rooms' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Rooms
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-floor')">
                    <router-link :to="{ name: 'floors' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Floors
                    </router-link>
                  </li>
                </ul>
              </li>

              <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                  <i class="app-menu__icon fa fa-th-list"></i>
                    <span class="app-menu__label">Utilities</span>
                  <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li v-if="hasAccess('view-diagnoses')">
                    <router-link :to="{ name: 'diagnoses' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Diagnoses
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-typeOfCharge')">
                    <router-link :to="{ name: 'typeOfCharges' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Type of Charges
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-discount')">
                    <router-link :to="{ name: 'discounts' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Discount
                    </router-link>
                  </li>
                  <li v-if="hasAccess('view-insurance')">
                    <router-link :to="{ name: 'insurances' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Insurance
                    </router-link>
                  </li>
                </ul>
              </li>
          </ul>
        </aside>
    </div>
</template>

<script>

    import { mapActions, mapGetters } from 'vuex';

    export default {
        components: {
        },

        props: {

        },

        data() {
            return {

            }
        },

        mounted() {
            this.sidebarToggle();
        },

        computed: {
          ...mapGetters(['currentUserDisplayName', 'displayUserRoles', 'hasAccess']),
        },

        methods: {

          sidebarToggle() {
            var treeviewMenu = $('.app-menu');

            // Toggle Sidebar
            $('[data-toggle="sidebar"]').click(function(event) {
              event.preventDefault();
              $('.app').toggleClass('sidenav-toggled');
            });

            // Activate sidebar treeview toggle
            $("[data-toggle='treeview']").click(function(event) {
              event.preventDefault();
              if(!$(this).parent().hasClass('is-expanded')) {
                treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
              }
              $(this).parent().toggleClass('is-expanded');
            });

            // Set initial active toggle
            $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

            //Activate bootstrip tooltips
            $("[data-toggle='tooltip']").tooltip();
          }
        },
    }
</script>
