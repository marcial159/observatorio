<template>
    <section class="content area">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
                <div class="col-xl-7 col-lg-7 col-md-7 cls-sm-7 col-xs-12 mx-auto">
                    <div v-if="show == 'loading'" class="animate__animated animate__fadeIn">
                        <div class="spinner-search">
                            <div class="double-bounce1"></div>
                            <div class="double-bounce2"></div>
                        </div>
                    </div>
                    <div v-if="show == 'error'" class="animate__animated animate__fadeIn">
                        <div class="card z-index-0">
                            <div class="card-body text-center">
                                <img :src="'/assets/img/404.svg'" width="400" height="200">
                                <h5>Lo lamentamos</h5>
                                <small class="d-block">No se encontró algún certificado con el código: <b>{{code }}</b></small>
                                <div class="row mt-2">
                                    <router-link :to="{name: 'Landing'}">
                                        <button type="button" class="btn btn-sm btn-secondary mb-0">Ir al Inicio</button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="show == 'certificate'" class="animate__animated animate__fadeIn">
                        <div class="card z-index-0">
                            <div class="card-body">
                                <result-component :data="data"></result-component>
                                <div class="col-12 mt-2 text-end">
                                    <router-link :to="{name: 'Landing'}">
                                        <button type="button" class="btn btn-sm btn-secondary mb-0"><i class="fa fa-arrow-left fs-6 me-2" aria-hidden="true"></i>Ir al Inicio</button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState } from 'vuex'

export default {
    data() {
        return {
            code : null,
            show : 'error',
            data : []
        }
    },

    components: {
        ResultComponent,
    },

    computed: mapState([ 'keys' ]),

    mounted() {
        this.code = this.$route.params.code
        this.search()
    },

    methods: {
        search: function(){
            this.show = 'loading'
            this.axios.post(this.$uri+'/certificate/verify',{'code' : this.code})
            .then( response => {
                if(response.status)
                {
                    this.show = 'certificate'
                    this.data = response.data.data
                }
                else{
                    this.show = 'error'
                }
            })
            .catch(error => {
                this.show = 'error'
            })
        }
    },
}
</script>