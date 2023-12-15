<template>
    <section class="content area">
        <div class="container">
            <div class="mt-lg-10 mt-0 md-11 mt-7">
                <div class="col-xl-3 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 animated pulse">
                        <form role="form text-left" id="recover-card" @submit.prevent="event">
                            <div class="card-body">
                                <div class="mb-2 text-center">
                                    <!-- <img :src="'../assets/img/logo.jpg'" width="80"> -->
                                    <h6>Restablecer contraseña</h6>
                                </div>
                                <div class="loading-validate">
                                    <!-- <stick-component :text="textStick" :type="typeStick" :icon="iconStick" v-show="showStick"></stick-component> -->
                                </div>
                                <p class="text-center text-xs">Ingrese sus datos por favor</p>
                                <label class="form-label mt-3">Correo Electrónico :</label>
                                <input v-model="email" :disabled="loading || bloking" name="email" type="email" class="form-control form-control-sm px-0" maxlength="50" autocomplete="new-email" required>

                                <div class="col-12" v-if="showInput">
                                    <label class="form-label mt-3">Código enviado a su correo :</label>
                                    <input v-model="code" :disabled="loading" name="code" type="code" class="form-control form-control-sm" minlength="4" maxlength="4" autocomplete="new-code" required>

                                    <label class="form-label mt-3">Nueva contraseña :</label>
                                    <input v-model="password" :disabled="loading" name="password" type="password" class="form-control form-control-sm" maxlength="50" autocomplete="new-password" required>

                                    <label class="form-label mt-3">Confirmar contraseña :</label>
                                    <input v-model="confirm" :disabled="loading" name="confirm" type="password" class="form-control form-control-sm" maxlength="50" autocomplete="off" required>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-6 text-center">
                                        <button type="button" @click="$router.go(-1)" class="btn btn-outline-secondary btn-sm w-100 mb-0">Atrás</button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <button type="submit" class="btn btn-success btn-sm w-100 mb-0" :disabled="loading">{{textBtn }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="js">
// import StickComponent from '../../../any/StickComponent.vue'
import vuenisimo      from '../../../helper/vuenisimo.js'
import { notify }     from '@kyvg/vue3-notification'

export default
{
    components : { 
        // StickComponent
    },

    data()
    {
        return {
            email     : '',
            code      : '',
            password  : '',
            confirm   : '',

            loading   : false,
            showInput : false,
            bloking   : false,

            recoment  : '',

            textStick : '',
            iconStick : '',
            typeStick : '',
            showStick : false,

            event     : this.recover,
            textBtn   : 'Enviar',

            area      : null,
        }
    },

    mounted()
    {
        this.area = document.getElementById('recover-card')
    },

    methods:
    {
        reset()
        {
            vuenisimo.loader( this.area, true )
            this.textStick = ''
            this.iconStick = ''
            this.typeStick = ''
            this.showStick = false
            this.loading   = true
            this.event     = this.reset
            this.showInput = true
            this.bloking   = true

            let data = {
                email                 : this.email,
                token                 : this.code,
                password              : this.password,
                password_confirmation : this.confirm,
                type                  : 1,
            }
            if(this.password == this.confirm)
            {
                this.axios.post(this.$uri+'/reset', data)
                .then( response => {
                    this.response = response.data
                    this.textStick = 'Contraseña cambiada correctamente!'
                    this.iconStick = 'fa-check-circle'
                    this.typeStick = 'success'
                    this.showStick = true
                    this.loading   = true
                    this.event     = this.reset
                    this.showInput = true
                    this.textBtn   = 'Redirigiendo al login..'
                    this.bloking   = true
                    notify({
                        type: "success",
                        duration: 2000,
                        title: "<i class='fas fa-check me-2'></i>Correcto",
                        text: "Contraseña reseteada correctamente!",
                        classes: "bg-success",
                        closeOnClick: true,
                        reverse: true
                    });
                    this.$router.push( {name: 'AdminLogin'} )
                })
                .catch( error => {
                    this.textStick = 'Error en los datos consignados.'
                    this.iconStick = 'fa-exclamation-circle'
                    this.typeStick = 'danger'
                    this.showStick = true
                    this.loading   = false
                    this.event     = this.reset
                    this.showInput = true
                    this.textBtn   = 'Aceptar'
                    this.bloking   = true
                })
                .finally(() => {
                    vuenisimo.loader( this.area, false )
                })
            }
            else{
                vuenisimo.loader( this.area, false )
                this.textStick = 'La nueva contraseña y su confirmación deben ser iguales'
                this.iconStick = 'fa-exclamation-circle'
                this.typeStick = 'danger'
                this.showStick = true
                this.loading   = false
                this.event     = this.reset
                this.showInput = true
                this.textBtn   = 'Aceptar'
                this.bloking   = true
            }
        },

        recover()
        {
            vuenisimo.loader( this.area, true )
            if(this.email !== '')
            {
                this.textStick = ''
                this.iconStick = ''
                this.typeStick = ''
                this.showStick = false
                this.loading   = true

                let data = {
                    email : this.email,
                    type  : 1,
                }

                this.axios.post(this.$uri+'/recover', data)
                .then( response => {
                    this.response = response.data
                    this.textStick = 'Enviamos el código a su correo!'
                    this.iconStick = 'fa-check-circle'
                    this.typeStick = 'success'
                    this.showStick = true
                    this.loading   = false
                    this.event     = this.reset
                    this.showInput = true
                    this.textBtn   = 'Aceptar'
                    this.bloking   = true
                    this.confirm   = ''
                })
                .catch(error => {
                    this.textStick = 'No se encontró el correo consignado.'
                    this.iconStick = 'fa-exclamation-circle'
                    this.typeStick = 'danger'
                    this.showStick = true
                    this.loading   = false
                })
                .finally(() => {
                    vuenisimo.loader( this.area, false )
                })
            }
            else{
                vuenisimo.loader( this.area, false )
                this.textStick = 'Ingrese los datos requeridos por favor.'
                this.iconStick = 'fa-exclamation-circle'
                this.typeStick = 'danger'
                this.showStick = true
            }
        },
    }
}
</script>
