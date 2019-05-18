<template>
    <div>
        <header class="app-header"><a class="app-header__logo" href="index.html">ibox</a>
          <!-- Sidebar toggle button-->
          <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
          <!-- Navbar Right Menu-->
          <ul class="app-nav">
            
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
              <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="#!" @click.prevent="logoutUser">
                        <i class="fa fa-sign-out fa-lg"></i> Logout
                    </a>
                </li>
              </ul>
            </li>
          </ul>
        </header>
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
          <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            <div>
              <p class="app-sidebar__user-name">Admin A Admin</p>
              <p class="app-sidebar__user-designation">Admin</p>
            </div>
          </div>
          <ul class="app-menu">
            <li>
                <router-link :to="{ name: 'home' }" class="app-menu__item">
                  <i class="app-menu__icon fa fa-dashboard"></i>
                  <span class="app-menu__label">Dashboard</span>
                </router-link>
              </li>
              <li>
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
                    <a class="treeview-item" href="#">
                      <i class="icon fa fa-circle-o"></i> In & Out Patient
                    </a>
                  </li>
                  <li>
                    <a class="treeview-item" href="#">
                      <i class="icon fa fa-circle-o"></i> Diagnoses
                    </a>
                  </li>
                  <li>
                    <a class="treeview-item" href="#">
                      <i class="icon fa fa-circle-o"></i> Laboratory
                    </a>
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
                    <a class="treeview-item" href="#">
                      <i class="icon fa fa-circle-o"></i> Rooms
                    </a>
                  </li>
                  <li>
                    <a class="treeview-item" href="#">
                      <i class="icon fa fa-circle-o"></i> Floors
                    </a>
                  </li>
                  <li>
                    <a class="treeview-item" href="#">
                      <i class="icon fa fa-circle-o"></i> Room Types
                    </a>
                  </li>
                </ul>
              </li>
          </ul>
        </aside>
        <main class="app-content">
            <slot></slot>
        </main>
    </div>
</template>

<script>

    import { mapActions } from 'vuex';

    export default {

        components: {
        },

        props: {},

        data() {
            return {
                
            }
        },

        mounted() {
            this.sidebarToggle();
        },

        computed: {

        },

        methods: {

            ...mapActions(['logout']),

            logoutUser() {
                
                const response = this.logout();

                // this.$store.commit('logout');

                response.then(res => {

                    this.$store.commit('logout');

                    this.$router.push({ name: 'login' });

                }).catch(error => {

                    if(error.response.status === 401) {

                      this.$store.commit('logout');

                      this.$router.push({ name: 'login' });

                    }

                });

            },

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
