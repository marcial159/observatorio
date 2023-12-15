<template>
    <section class="content area">
        <div class="container">
            <div class="mt-md-9 mt-sm-5">
                <div v-if="show == 'loading'" class="animate__animated animate__fadeIn pt-2">
                    <div class="spinner-search">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>
                <div v-if="show == 'error'" class="animate__animated animate__fadeIn">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-md-4 col-xs-12">
                            <div class="card card-landing z-index-0">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img :src="'/assets/img/unsuscrible.svg'" class="w-50">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-center mb-0 mt-2 fs-5">Lo Lamentamos</h5>
                                            <small class="d-block  text-center fs-6 mb-3">El registro a este evento ha finalizado.</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <a class="btn btn-sm btn-info" target="_blank" href="https://itec123.com/">ver más cursos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div v-if="show == 'event'" class="animate__animated animate__fadeIn">
                    <div class="row">
                        <div class="col-md-4 col-xs-0"></div>
                        <div class="col-md-4 col-xs-12">
                            <div class="card card-landing">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <form class="position-relative" id="register" @submit="register">
                                            <div class="p-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-center text-muted fs-7">
                                                            Bienvenid@, registra tu participación en el evento:
                                                        </h5>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="text-center fs-6">
                                                            {{ data.title }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="" for="document">Cédula ó documento de identidad*:</label>
                                                        <input type="text" @input="reload" name="document" class="form-control form-control-sm" autocomplete="off" maxlength="20" required>
                                                        <p error="document" class="error"></p>
                                                    </div>
                                                </div>
                                                <div class="row" v-if="dissabled">
                                                    <div class="col-6">
                                                        <div class="mb-1">
                                                            <small class="fs-6">Nombre(s)  (*)</small>
                                                            <input type="text" name="firstname" class="form-control form-control-sm" required maxlength="50" autocomplete="off">
                                                            <p error="firstname" class="error"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-1">
                                                            <small class="fs-6">Apellidos  (*)</small>
                                                            <input type="text" name="lastname" class="form-control form-control-sm" required maxlength="50" autocomplete="off">
                                                            <p error="lastname" class="error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-1" v-if="dissabled">
                                                    <small class="fs-6">Región  (*)</small>
                                                    <select-region required :options="regions" :value="select" @region="region"></select-region>
                                                    <p error="region" class="error"></p>
                                                </div>
                                                <div class="row mb-3" v-if="dissabled">
                                                    <div class="col-6">
                                                        <div class="mb-1">
                                                            <small class="fs-6">Email  (*)</small>
                                                            <input type="email" name="email" class="form-control form-control-sm" required maxlength="100" autocomplete="off">
                                                            <p error="email" class="error"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-1">
                                                            <small class="fs-6">Celular  (*)</small>
                                                            <input v-if="dissabled" type="text" name="phone" class="form-control form-control-sm" required minlength="9" maxlength="30" autocomplete="off">
                                                            <p error="phone" class="error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <button class="btn btn-primary w-100 mb-0 py-2"><i class="fa fa-check-circle-o me-2 fs-6" aria-hidden="true"></i>{{text }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div v-if="show == 'success'" class="animate__animated animate__fadeIn">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-md-4 col-xs-12">
                            <div class="card card-landing">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h5><i class="fa fa-check-circle-o me-2" aria-hidden="true"></i>Felicidades!</h5>
                                            <h5 class="fs-6">{{ (user.firstname) ? user.firstname : '' }} {{ (user.lastname) ? user.lastname : ''  }}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-center text-muted fs-6 mb-0">
                                                Su participación fue registrada exitosamente.
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center mt-3">
                                            <router-link class="btn btn-sm btn-primary text-end mb-0" :to="{name: 'UserLogin'}">
                                                Iniciar Sesión
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div v-if="show == 'duplicate'" class="animate__animated animate__fadeIn">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-md-4 col-xs-12">
                            <div class="card card-landing">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-center text-muted fs-6 mb-0">
                                                Su participación ya fue registrado previamente.
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center mt-3">
                                            <router-link class="btn btn-sm btn-primary text-end mb-0" :to="{name: 'UserLogin'}">
                                                Iniciar Sesión
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import vuenisimo from '../../helper/vuenisimo.js'
import regions from '../../helper/regions.js'
import SelectRegion from '../../admin/modules/participations/SelectRegion.vue'
import { notify } from "@kyvg/vue3-notification"

export default {
    components: {
        SelectRegion,
    },

    data() {
        return {
            event : null,
            show : 'loading',
            form : null,
            data : [],
            dissabled : false,
            regions : null,
            select : null,
            text: 'Validar',
            user: null,
        }
    },

    mounted() {
        this.event = this.$route.params.event
        this.regions = regions

        this.live()
    },

    methods: {
        region: function(id)
        {
            this.select = id
        },

        live: function()
        {
            this.user = null
            this.show = 'loading'
            this.axios.post(this.$uri+'/event/attendance',{'event' : this.event})
            .then( response => {
                if(response.data.live)
                {
                    this.show = 'event'
                    this.data = response.data
                }
                else
                {
                    this.show = 'error'
                }
            })
            .catch(error => {
                this.show = 'error'
            })
        },

        reload: function()
        {
            this.user = null
            this.select = null
            this.text = 'Validar'
            this.dissabled = false
        },

        register: function(e)
        {
            e.preventDefault()
            this.user = null
            this.text = 'Validar'
            this.form = document.getElementById('register')
            vuenisimo.loader( this.form, true )
            vuenisimo.clearError( this.form )
            let data = vuenisimo.getData( this.form )
            data.region = this.region
            data.event = this.event
            this.axios.post(this.$uri+'/participation/validation',data)
            .then( response => {
                if(response.status == 201)
                {
                    vuenisimo.loader( this.form, false )
                    this.show = 'success'
                    this.user = response.data
                }
            })
            .catch(error => {
                if(error.response.status == 402)
                {
                    vuenisimo.loader( this.form, false )
                    this.dissabled = true
                    this.show = 'duplicate'
                }

                if(error.response.status == 403)
                {
                    vuenisimo.loader( this.form, false )
                    this.dissabled = true
                    this.text = 'Registrarme'
                    this.show = 'error'
                }

                if(error.response.status == 404)
                {
                    vuenisimo.loader( this.form, false )
                    this.text = 'Registrarme'
                    this.dissabled = true
                }
                if(error.response.status == 422)
                {
                    vuenisimo.loader( this.form, false )
                    this.text = 'Registrarme'
                    vuenisimo.error( error.response, this.form )
                }
                if(error.response.status == 500)
                {
                    notify({
                    type: "danger",
                    duration: 2000,
                    title: "<i class='fas fa-check me-2'></i>Correcto",
                    text: "Error inesperado, intentelo más tarde.",
                    classes: "bg-danger",
                    closeOnClick: true,
                    reverse: true
                });
                }
            })
        }
    },
}
</script>
