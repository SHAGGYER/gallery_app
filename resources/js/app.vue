<template>
    <div>
        <app-navbar :app="this"></app-navbar>



        <spinner class="bigSpinner"
                 size="massive"
                 line-fg-color="#4CAF50"
                 v-if="$store.state.loading"
                 message="Loading...">
        </spinner>
        <div v-else>
            <transition name="fade">
                <router-view :app="this" style="margin-top: 25px; margin-bottom: 50px"></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
    import NProgress from 'nprogress';
    import Helper from './utils/helper';
    import AppNavbar from "./components/app.navbar";





    export default {
        name: "app",
        components: {AppNavbar},
        data()
        {
            return {
                request: axios.create({
                    baseUrl: BASE_URL
                }),
                user: null,
                helper: Helper,
            }
        },

        mounted()
        {
            this.request.interceptors.request.use(config => {
                NProgress.start();
                return config;
            });

            this.request.interceptors.response.use(response => {
                NProgress.done();
                return response;
            });

            this.init();
        },

        methods: {
            init()
            {
                let $this = this;

                this.$store.commit('setLoading', true);

                this.request.post('auth/init').then(function (response) {

                    if (response.data.id)
                    {
                        $this.user = response.data;

                    }

                    $this.$store.commit('setLoading', false);
                });
            },
        }
    }
</script>

<style>
    .fade-enter-active {
        transition: opacity .5s;
    }
    .fade-enter /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

    .bigSpinner
    {
        margin: 30% auto auto;

    }
</style>