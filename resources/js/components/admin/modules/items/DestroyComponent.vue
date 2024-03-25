<template>
    <div class="modal fade" id="itemDestroyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit="destroyEvent" id="itemDestroyForm">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm">
                                    <i class="lni lni-trash-can me-1 fw-bold text-success"></i>
                                    Eliminar rubro
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">¿Seguro que quiere eliminar este rubro <strong>"{{ element?.name }}"</strong>?</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end mt-3">
                                <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger btn-sm fs-7 mb-0">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import vuenisimo from '../../../helper/vuenisimo.js'

export default
{
    data()
    {
        return {
            modal : null,
            form  : null,
            element : null,
        }
    },

    mounted()
    {
        this.modal = new bootstrap.Modal(document.getElementById( `itemDestroyModal` ))
        this.form = document.getElementById( `itemDestroyForm` )
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
            vuenisimo.loader( this.form,true )
            this.axios.delete( `${this.$uri}/item/${this.element.id}` )
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
            .finally(() =>
            {
                vuenisimo.loader( this.form , false )
            })
        },
    },
}
</script>
