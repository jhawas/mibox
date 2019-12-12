<template>
    <div>
        <header class="app-header"><a class="app-header__logo" href="index.html">ibox</a>
          <!-- Sidebar toggle button-->
          <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
          <!-- Navbar Right Menu-->
          <ul class="app-nav">
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                    <i class="fa fa-bell-o fa-lg" @click="handleNotification"></i>
                </a>
                <span 
                    v-if="allUnReadNotifications.length > 0"
                    class="badge badge-light"
                    style="position: absolute;
                        top: 10px;
                        right: 0;"
                >{{allUnReadNotifications.length}}</span>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <!-- <li class="app-notification__title">You have {{allUnReadNotifications.length}} new notifications.</li> -->
                    <div class="app-notification__content">
                        <li v-for="(notification, index) in allNotifications" :key="index">
                            <a class="app-notification__item" href="javascript:;" @click="onClickNotification(notification.data)">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                                <div v-if="notificationType(notification,'user')">
                                    <p class="app-notification__message">{{notification.data.data.user.full_name}}</p>
                                    <p class="app-notification__meta">{{notification.data.data.message}}</p>
                                    <!-- <p class="app-notification__meta">2 min ago</p> -->
                                </div>
                                <div v-if="notificationType(notification,'patient')">
                                    <p class="app-notification__message">{{notification.data.data.patient.first_name + ' ' + notification.data.data.patient.middle_name + ' ' + notification.data.data.patient.last_name}}</p>
                                    <p class="app-notification__meta">{{notification.data.data.message}}</p>
                                    <!-- <p class="app-notification__meta">2 min ago</p> -->
                                </div>
                                <div v-if="notificationType(notification,'patientRecord')">
                                    <p class="app-notification__message">{{notification.data.data.patient.patient.first_name + ' ' + notification.data.data.patient.patient.middle_name + ' ' + notification.data.data.patient.patient.last_name}}</p>
                                    <p class="app-notification__meta">{{notification.data.data.message}}</p>
                                    <!-- <p class="app-notification__meta">2 min ago</p> -->
                                </div>
                                <div v-if="notificationType(notification,'doctorsOrder')">
                                    <p class="app-notification__message">{{notification.data.data.patient.orders}}</p>
                                    <p class="app-notification__meta">{{notification.data.data.message}}</p>
                                    <!-- <p class="app-notification__meta">2 min ago</p> -->
                                </div>
                            </a>
                        </li>
                    </div>
                    <!-- <li class="app-notification__footer"><a href="#">See all notifications.</a></li> -->
                </ul>
                </li>
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
            this.fetchNotifications();
            this.fetchUnReadNotifications();
        },

        sockets: {
            connect() {
                console.log('socket connected');
            },
            notification(data) {
                this.fetchUnReadNotifications();
                this.fetchNotifications();
            }
        },

        computed: {

            ...mapGetters(['currentUserDisplayName', 'displayUserRoles', 'allNotifications', 'allUnReadNotifications']),

        },

        methods: {

            ...mapActions(['logout', 'fetchNotifications', 'fetchUnReadNotifications', 'markAllAsRead']),
            
            refreshNotification() {
                this.fetchUnReadNotifications();
                this.fetchNotifications();
            },

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

            handleNotification() {

                let formData = new FormData();

                formData.append('notification', this.allUnReadNotifications);

                const response = this.markAllAsRead({formData: formData});
            },

            notificationType(notification, type) {
                if(notification.data.data.type === type) {
                    return true;
                }
            },

            onClickNotification(data) {
                if(data.data.type == 'user') {
                    const user = data.data.user;
                    this.$router.push({ name: 'user-show', params: { id:  user.id } });
                }
                if(data.data.type == 'patient') {
                    const patient = data.data.patient;
                    this.$router.push({ name: 'patient-show', params: { id: patient.id } });
                }
                if(data.data.type == 'patientRecord') {
                    const patientRecord = data.data.patient;
                    this.$router.push({ name: 'patientRecord-show', params: { id: patientRecord.id } });
                }
                if(data.data.type == 'doctorsOrder') {
                    const doctorsOrder = data.data.patient;
                    this.$router.push({ name: 'doctorsOrder-show', params: { id: doctorsOrder.id } });
                }
            }

        },
    }
</script>
