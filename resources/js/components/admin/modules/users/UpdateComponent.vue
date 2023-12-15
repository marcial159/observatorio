<template>
    <div class="modal fade" id="userUpdateModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit="updateEvent" id="userUpdateForm">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5 class="modal-title text-sm d-inline-block">
                                    <i class="lni lni-pencil-alt me-1 fw-bold text-success"></i>
                                    Modificar usuario
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Nombres (*)</label>
                                <input type="text" name="firstname" class="form-control form-control-sm" required maxlength="50" autocomplete="new-first">
                                <p error="firstname" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Apellidos (*)</label>
                                <input type="text" name="lastname" class="form-control form-control-sm" required maxlength="50" autocomplete="new-lastname">
                                <p error="lastname" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Correo electrónico (*)</label>
                                <input type="email" name="email" class="form-control form-control-sm" required maxlength="100" autocomplete="new-email">
                                <p error="email" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Celular (*)</label>
                                <input type="text" name="phone" class="form-control form-control-sm" minlength="9" maxlength="30" autocomplete="off">
                                <p error="phone" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Sexo (*)</label>
                                <select class="form-select form-select-sm" name="gender">
                                    <option value="" selected>- Seleccionar -</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                <p error="gender" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Rol (*)</label>
                                <Multiselect
                                v-model="role_id"
                                :options="roles"
                                :noResultsText="'Sin resultados'"
                                :searchable="true"
                                :closeOnSelect="true"
                                placeholder="- Seleccionar -"
                                :required="true"
                                />
                                <p class="error" error="role_id"></p>
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
import Multiselect from '@vueform/multiselect'

export default
{
    props:
    {
        roles : Object,
    },

    data()
    {
        return {
            element : null,
            modal : null,
            form : null,
            disabled : true,
            role_id : null,
        }
    },

    components:
    {
        Multiselect,
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( 'userUpdateModal' ) )
        this.form = document.getElementById( 'userUpdateForm' )
    },

    methods:
    {
        update( element )
        {
            this.element = element
            vuenisimo.loader( this.form, true )
            this.modal.show()
            vuenisimo.clearData( this.form )
            vuenisimo.clearError( this.form )
            this.axios.get( `${this.$uri}/user/${element.id}` )
            .then( response =>
            {
                this.role_id = response.data.role.role_id
                vuenisimo.setData( this.form, response.data.person )
                vuenisimo.setData( this.form, response.data )
            })
            .catch( error =>
            {
                vuenisimo.error( error.response )
            })
            .finally( () =>
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
            data.person_id = this.element.person_id
            data.role_id = this.role_id
            this.axios.put( `${this.$uri}/user/${this.element.id}`, data )
            .then( response => {
                this.modal.hide()
                this.$emit( 'row', response.data )
                vuenisimo.updateNotification()
            })
            .catch( error => {
                vuenisimo.error( error.response, this.form )
            })
            .finally(() => {
                vuenisimo.loader( this.form, false )
                vuenisimo.processing( this.modal, false )
            })
        },
    },
}
</script>
