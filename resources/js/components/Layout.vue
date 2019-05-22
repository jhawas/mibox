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
        <main-sidebar></main-sidebar>
        <main class="app-content">
            <slot></slot>
        </main>
    </div>
</template>

<script>

    import { mapActions, mapGetters } from 'vuex';
    import MainSidebar from './MainSidebar';

    export default {

        components: {
          MainSidebar
        },

        props: {},

        data() {
            return {
                
            }
        },

        mounted() {

        },

        computed: {

            ...mapGetters(['currentUserDisplayName', 'displayUserRoles']),

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

        },
    }
</script>
