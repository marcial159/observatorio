<template>
    <div class="modal fade" id="resetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form @submit="resetEvent" id="resetForm">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm">Cambio de contraseña</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Nueva contraseña  (*)</label>
                                <input :disabled="loading" name="password" type="text" class="form-control form-control-sm" minlength="6" maxlength="50" autocomplete="new-password" required>
                                <p error="password" class="error"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Confirmar contraseña  (*)</label>
                                <input :disabled="loading" name="password_confirmation" type="password" class="form-control form-control-sm" minlength="6" maxlength="50" autocomplete="new-password" required>
                                <p error="password_confirmation" class="error"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-secondary btn-sm fs-7 mb-0 me-2" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success btn-sm fs-7 mb-0">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import vuenisimo from '../helper/vuenisimo.js'
import { notify } from "@kyvg/vue3-notification"
export default {
    data() {
        return {
            modal : null,
            form : null,
            id : null,
            loading : false,
        }
    },

    mounted() {
        this.modal = new bootstrap.Modal(document.getElementById('resetModal'))
        this.form = document.getElementById('resetForm')
    },

    methods: {
        reset: function(id)
        {
            this.modal.show()
            vuenisimo.clearError( this.form )
            vuenisimo.clearData( this.form )
        },

        resetEvent: function(e)
        {
            e.preventDefault()
            vuenisimo.loader( this.form, true )
            this.loading = true
            let data = vuenisimo.getData( this.form )
            data.token = JSON.parse(localStorage.getItem('user')).token
            data.email = JSON.parse(localStorage.getItem('user')).email
            this.axios.post(this.$uri+'/user/repassword', data)
            .then( response => {
                this.loading   = true
                this.modal.hide()
                localStorage.removeItem( 'user' )
                localStorage.removeItem( 'dashboard' )
                notify({
                    type: "success",
                    duration: 2000,
                    title: "<i class='fas fa-check me-2'></i>Correcto",
                    text: "Contraseña reseteada",
                    classes: "bg-success",
                    closeOnClick: true,
                    reverse: true
                });
                this.$router.push( {name: 'AdminLogin'} )
            })
            .catch( error => {
                vuenisimo.error( error.response, this.form )
            })
            .finally(() => {
                vuenisimo.loader( this.form, false )
                this.loading = false
            })
        }
    }
}
</script>
