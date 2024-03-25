<template>
    <div class="modal fade" :id="`${id}Modal`" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit="updateEvent" :id="`${id}Form`">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm d-inline-block">
                                    <i class="lni lni-pencil-alt me-1 fw-bold text-success"></i>
                                    Modificar Concurso
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label class="form-label">Titulo (*)</label>
                                <input type="text" name="name" class="form-control form-control-sm" maxlength="30" autocomplete="off" required>
                                <p error="name" class="error"></p>
                            </div>
                            <div class="col-7">
                                <label class="form-label">Tipo de Proyecto (*)</label>
                                <input type="text" name="type_project_id" class="form-control form-control-sm" maxlength="40" autocomplete="off" required>
                                <p error="type_project_id" class="error"></p>
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
            element : null,
            modal : null,
            form  : null,
        }
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( `${this.id}Modal` ) )
        this.form = document.getElementById( `${this.id}Form` )
    },

    methods:
    {
        update( element )
        {
            this.element = element
            this.modal.show()
            vuenisimo.clearData( this.form )
            vuenisimo.clearError( this.form )
            vuenisimo.loader( this.form, true )
            this.axios.get( `${this.$uri}/carrer/${element.id}` )
            .then( response =>
            {
                vuenisimo.setData( this.form, response.data )
            })
            .catch( error =>
            {
                vuenisimo.error( error.response )
            })
            .finally(() =>
            {
                vuenisimo.loader( this.form, false )
            })
        },

        updateEvent( e )
        {
            e.preventDefault()
            vuenisimo.clearError( this.form )
            vuenisimo.loader( this.form, true )
            vuenisimo.processing( this.modal, true )
            let data = vuenisimo.getData( this.form )
            data.id = this.element.id
            this.axios.put( `${this.$uri}/carrer/${this.element.id}`, data )
            .then( response =>
            {
                this.modal.hide()
                this.$emit( `row`, response.data )
                vuenisimo.updateNotification()
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
        },
    },
}
</script>
