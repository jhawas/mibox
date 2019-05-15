<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> User Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">User Page</a></li>
                </ul>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                    <b-form @submit="onSubmit">
                      <b-row>
                         <b-col col lg="6">
                            <b-form-group
                              id="input-group-first-name"
                              label="First Name:"
                              label-for="first_name"
                            >
                              <b-form-input
                                id="first_name"
                                v-model="form.first_name"
                                type="text"
                                
                                placeholder="Enter First Name"
                              />
                            </b-form-group>
                            <b-form-group
                              id="input-group-middle-name"
                              label="Middle Name:"
                              label-for="middle_name"
                            >
                              <b-form-input
                                id="middle_name"
                                v-model="form.middle_name"
                                type="text"
                                required
                                placeholder="Enter Middle Name"
                              />
                            </b-form-group>
                            <b-form-group
                              id="input-group-last-name"
                              label="Last Name:"
                              label-for="last_name"
                            >
                              <b-form-input
                                id="last_name"
                                v-model="form.last_name"
                                type="text"
                                required
                                placeholder="Enter Last Name"
                              />
                            </b-form-group>
                            <!-- <b-form-group
                              id="input-group-1"
                              label="Email address:"
                              label-for="input-1"
                              description="We'll never share your email with anyone else."
                            >
                              <b-form-input
                                id="input-1"
                                v-model="form.email"
                                type="email"
                                required
                                placeholder="Enter email"
                              />
                            </b-form-group> -->
                         </b-col>
                         <b-col col lg="6">
                            
                         </b-col>
                      </b-row>
                      <b-button type="submit" variant="primary">Save</b-button>
                      <b-button type="button" variant="primary" @click="cancel">Cancel</b-button>
                    </b-form>
                </div>
              </div>
           </div>
        </div>
    </div>
</template>

<script>

    export default {
        components: {

        },

        props: {

        },

        data() {
            return {
                form: {
                    first_name: null,
                    middle_name: null,
                    last_name: null
                },
            }
        },

        mounted() {

        },

        computed: {
          
        },

        methods: {

          onSubmit(event) {

            event.preventDefault();

            let formData = new FormData();

            formData.append('first_name', this.form.first_name);
            formData.append('middle_name', this.form.middle_name);
            formData.append('last_name', this.form.last_name);
            
            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            axios.post('/api/users', formData, config)
              .then(response => {
                  
                  console.log('success', response); 
                  
                  // this.$router.push({ name: 'users' });

              })
              .catch (error => {
                  console.log('error', error.response.data.errors);
              });

          },

          cancel() {

            this.$router.push({ name: 'users' });

          }

        },
    }
</script>
