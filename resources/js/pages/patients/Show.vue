<template>
    <Layout>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Patient Page</h1>
                  <p>Start a beautiful journey here</p>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                  <li class="breadcrumb-item"><a href="#">Patient Page</a></li>
                </ul>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                    <b-button type="button" variant="primary" @click="cancel">Cancel</b-button>
                </div>
              </div>
           </div>
        </div>
    </Layout>
</template>

<script>
    
    import Layout from '../../components/Layout';

    export default {
        components: {
            Layout
        },

        props: {

        },

        data() {
            return {
                
            }
        },

        mounted() {

        },

        computed: {
          
        },

        methods: {

          cancel() {

            this.$router.push({ name: 'patients' });

          }

        },
    }
</script>
