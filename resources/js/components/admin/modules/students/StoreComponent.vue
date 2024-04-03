<template>
    <div class="modal fade" :id="`${id}Modal`" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit="storeEvent" :id="`${id}Form`">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm">
                                    <i class="lni lni-circle-plus me-1 fw-bold text-success"></i>
                                    Nueva Estudiante
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label class="form-label">Estudiante (*)</label>
                                <input type="text" name="person_id" class="form-control form-control-sm" maxlength="30" autocomplete="off" required>
                                <p error="program" class="error"></p>
                            </div>
                            <div class="col-7">
                                <label class="form-label">Codigo (*)</label>
                                <input type="text" name="code" class="form-control form-control-sm" maxlength="40" autocomplete="off" required>
                                <p error="name" class="error"></p>
                            </div>
                            <div class="col-7">
                                <label class="form-label">Sede (*)</label>
                                <input type="text" name="asignament_id" class="form-control form-control-sm" maxlength="40" autocomplete="off" required>
                                <p error="acronym" class="error"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end mt-3">
                                <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2" data-bs-dismiss="modal">Cancelar</button>
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
import vuenisimo from '../../../helper/vuenisimo.js'

export default
{
    props:
    {
        id : String,
    },

    data()
    {
        return {
            modal : null,
            form : null,
        }
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( `${this.id}Modal` ) )
        this.form = document.getElementById( `${this.id}Form` )
    },

    methods:
    {
        store()
        {
            vuenisimo.clearData( this.form )
            vuenisimo.clearError( this.form )
            this.modal.show()
        },

        storeEvent( e )
        {
            e.preventDefault()
            vuenisimo.loader( this.form, true )
            vuenisimo.processing( this.modal, true )
            let data = vuenisimo.getData( this.form )
            vuenisimo.clearError( this.form )
            this.axios.post( `${this.$uri}/student`, data )
            .then( response =>
            {
                vuenisimo.clearData( this.form )
                this.modal.hide()
                this.$emit( `reload`, true )
                vuenisimo.storeNotification()
            })
            .catch( error =>
            {
                vuenisimo.error( error.response, this.form )
            })
            .finally(() =>
            {
                vuenisimo.loader( this.form, false )
                vuenisimo.processing( this.modal, false )
            })
        }
    },
}
</script>
