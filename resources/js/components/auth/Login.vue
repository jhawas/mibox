<template>
    <div>
      <section class="material-half-bg">
        <div class="cover"></div>
      </section>
      <section class="login-content">
          <div class="logo">
            <h1>Ibox</h1>
        </div>
        <div class="login-box">
            <form class="login-form" @submit.prevent="onSubmit">
              <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
              <div class="form-group has-danger">
                  <label class="control-label">USERNAME</label>
                  <input 
                    v-model="form.username"
                    id="username" 
                    type="text" 
                    :class="['form-control', errors.username ? 'is-invalid' : '']" 
                    name="username" 
                    autofocus
                  >
                  <div class="form-control-feedback" v-if="errors.username">{{ errors.username[0] }}</div>
              </div>
              <div class="form-group">
                  <label class="control-label">PASSWORD</label>
                  <input 
                    v-model="form.password"
                    id="password" 
                    type="password" 
                    :class="['form-control', errors.password ? 'is-invalid' : '']" 
                    name="password"
                  >
                  <div class="form-control-feedback" v-if="errors.username">{{ errors.password[0] }}</div>
              </div>
              <!-- <div class="form-group">
                  <div class="utility">
                    <div class="animated-checkbox">
                      <label>
                          <input class="label-text" type="checkbox" name="remember" id="remember"><span class="label-text">Remember Me</span>
                      </label>
                    </div>
                    <p class="semibold-text mb-2"><a href="" data-toggle="flip">Forgot Password ?</a></p>
                  </div>
               </div> -->
              <div class="form-group btn-container">
                  <button class="btn btn-primary btn-block" :disabled="loading">
                    <i :class="{ 'fa fa-lg fa-fw fa-spinner': loading, 'fa fa-lg fa-fw fa-sign-in': !loading }"></i>SIGN IN
                  </button>
              </div>
            </form>
        </div>
      </section>
    </div>
</template>

<script>
  
  import { mapActions } from 'vuex';
  import toastr from 'toastr';

    export default {

        components: {

        },

        props: {},

        data() {
            return {
              form: {
                username: '',
                password: ''
              },
              loading: false,
              errors: [],
            }
        },

        mounted() {},

        computed: {},

        methods: {

          ...mapActions(['login']),

          onSubmit(event) {

            let formData = new FormData();

            formData.append('username', this.form.username);
            formData.append('password', this.form.password);

            this.loading = true;

            this.login(formData).then( response => {
              
              this.loading = false;

              toastr.success(response.data.message, 'Message');

              this.$router.push({ name: 'home' });

            }).catch( error => {

              this.loading = false;

              this.errors = error.response.data.errors;

            });

            
          }
        },

    }
</script>