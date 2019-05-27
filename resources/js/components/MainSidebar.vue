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
              <li v-if="hasAccess('create-user')">
                <router-link :to="{ name: 'users' }" class="app-menu__item">
                    <i class="app-menu__icon fa fa-pie-chart"></i>
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
                  <li>
                    <router-link :to="{ name: 'patients' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Patient Information
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> In & Out Patient
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'nurseNotes' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Nurses Notes
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'medicationAndTreatments' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Medication and Treatments
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Vital Signs
                    </router-link>
                  </li><li>
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Intravenouse Fluids
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Doctors Order
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Laboratory
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'patientRecords' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Diagnoses
                    </router-link>
                  </li>
                </ul>
              </li>
              <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                  <i class="app-menu__icon fa fa-th-list"></i>
                    <span class="app-menu__label">Manage Rooms</span>
                  <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <router-link :to="{ name: 'rooms' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Rooms
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'floors' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Floors
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'typeOfRooms' }" class="treeview-item">
                      <i class="icon fa fa-circle-o"></i> Type Of Rooms
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
