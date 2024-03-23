<template>
    <div class="row position-relative">
        <div class="position-absolute">
            <div class="mt-lg-8 mt-2 md-11">
                <div class="col-xl-3 col-lg-5 col-md-7 mx-auto position-relative">
                    <div class="card z-index-0 animated pulse animate__animated animate__fadeInDown">
                        <form id="adminLogin" role="form text-left" @submit.prevent="login">
                            <div class="card-body">
                                <div class="mb-3 text-center">
                                    <img :src="'../assets/img/Unamba.png'" class="w-25" alt="main_logo">
                                    <h6 class="">Iniciar sesión</h6>
                                </div>
                                <div class="loading-validate text-center">
                                    <span v-show="error" class="badge badge-xs bg-gradient-danger">Usuario o contraseña no válido</span>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Correo electrónico (*)</label>
                                        <input type="email" name="email" class="form-control form-control-sm" maxlength="50" autocomplete="on" required>
                                        <p error="email" class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Contraseña (*)</label>
                                        <input type="password" name="password" class="form-control form-control-sm" maxlength="50" autocomplete="on" required>
                                        <p error="password" class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-success text-dark btn-sm w-100 my-2 mb-2 py-2">Ingresar</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-xs mt-1 mb-0">Olvidaste tu contraseña?
                                        <router-link :to="{name : 'AdminRecover'}">
                                            <strong>Click aqui!</strong>
                                        </router-link>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vuenisimo from '../../../helper/vuenisimo.js'
import { notify }     from '@kyvg/vue3-notification'

export default
{
    components:
    { 
    },

    data()
    {
        return {
            form      : null,
            response  : null,
            userDetails: null,
            error : false,
        }
    },

    mounted()
    {
        this.form = document.getElementById('adminLogin')
    },

    methods: 
    {
        async dashboard()
        {
            await axios.post(this.$uri+'/admin/dashboard')
            .then( response =>
            {
                localStorage.setItem('dashboard',JSON.stringify(response.data))
            })
            .catch( error => 
            {
                notify({
                    type: "error",
                    duration: 2000,
                    title: "<i class='fas fa-check me-2'></i>Algo salió mal",
                    text: 'Intentelo más tarde',
                    classes: "bg-success",
                    closeOnClick: true,
                    reverse: true
                })
            })
        },

        async login()
        {
            vuenisimo.loader( this.form, true )
            let data = vuenisimo.getData( this.form )
            this.error = false

            if( data.email && data.password )
            {
                await this.dashboard()

                await axios.post(this.$uri+'/login', data)
                .then( response =>
                {
                    localStorage.setItem( 'user', JSON.stringify( response.data ) )
                    this.$router.push( {name: 'AdminDashboard'} )
                })
                .catch( error => 
                {
                    this.error = true
                })
                .finally( () =>
                {
                    vuenisimo.loader( this.form, false )
                })
            }
        },
    },
}
</script>