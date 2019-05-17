<template>
    <div class="page-error tile">
      <h1><i class="fa fa-exclamation-circle"></i> Error 404: Page not found</h1>
      <p>The page you have requested is not found.</p>
      <p><button class="btn btn-primary" @click="goBack">Go Back</button></p>
    </div>
</template>

<script>

	import Layout from '../components/Layout';

    export default {
        components: {
            Layout
        },

        props: {},

        data() {
            return {}
        },

        mounted() {

        },

        computed: {

        },

        methods: {
        	goBack() {
        		this.$router.push({ name: 'home' });
        	}
        },
    }
</script>
