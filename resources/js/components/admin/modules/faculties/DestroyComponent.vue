<template>
    <div class="modal fade" :id="`${id}Modal`" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit="destroyEvent" :id="`${id}Form`">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="modal-title text-sm">
                                    <i class="lni lni-trash-can me-1 fw-bold text-success"></i>
                                    Eliminar Facultad
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 my-3">
                                <label class="text-xs mb-0">¿Seguro que quieres eliminar la Facultad "<b>{{ element?.name  }}</b>"?</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-dark btn-sm mb-0 me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger btn-sm mb-0">Eliminar</button>
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
            element : null,
        }
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( `${this.id}Modal` ) )
        this.form = document.getElementById( `${this.id}Form` )
    },

    methods:
    {
        destroy( element )
        {
            this.modal.show()
            this.element = element
        },

        destroyEvent( e )
        {
            e.preventDefault()
            vuenisimo.loader( this.form, true )
            vuenisimo.processing( this.modal, true )
            this.axios.delete( `${this.$uri}/faculty/${this.element.id}` )
            .then( response => 
            {
                this.modal.hide()
                this.$emit( `reload`, true )
                vuenisimo.destroyNotification()
            })
            .catch( error =>
            {
                vuenisimo.error( error.response )
            })
            .finally( () =>
            {
                vuenisimo.loader( this.form, false )
                vuenisimo.processing( this.modal, false )
            })
        },
    },
}
</script>
