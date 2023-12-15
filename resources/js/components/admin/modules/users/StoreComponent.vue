<template>
    <div class="modal fade" id="userStoreModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="modal-title text-sm">
                                <i class="lni lni-circle-plus me-1 fw-bold text-success"></i>
                                Nuevo usuario
                            </h5>
                        </div>
                    </div>
                    <form @submit="storeEvent" id="userStoreForm" class="position-relative">
                        <div class="row">
                            <form id="userSearchForm">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-label">DNI (*)</label>
                                        <reniec-find-component @response="reniecResponse"/>
                                        <p error="document" class="error"></p>
                                    </div>
                                </div>
                            </form>
                            <div class="col-6">
                                <label class="form-label">Nombres (*)</label>
                                <input type="text" name="firstname" class="form-control form-control-sm" required maxlength="50" autocomplete="new-first" :disabled="disabled">
                                <p error="firstname" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Apellidos (*)</label>
                                <input type="text" name="lastname" class="form-control form-control-sm" required maxlength="50" autocomplete="new-lastname" :disabled="disabled">
                                <p error="lastname" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Correo electrónico (*)</label>
                                <input type="email" name="email" class="form-control form-control-sm" required maxlength="100" autocomplete="new-email" :disabled="disabled">
                                <p error="email" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Celular (*)</label>
                                <input type="text" name="phone" class="form-control form-control-sm" minlength="9" maxlength="30" autocomplete="off" :disabled="disabled">
                                <p error="phone" class="error"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Sexo (*)</label>
                                <select class="form-select form-select-sm" name="gender" :disabled="disabled">
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
                                :disabled="disabled"
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import vuenisimo from '../../../helper/vuenisimo.js'
import ReniecFindComponent from '../../../any/ReniecFindComponent.vue'
import Multiselect from '@vueform/multiselect'

export default
{
    props:
    {
        roles : Object,
    },

    data()
    {
        return{
            modal : null,
            form : null,
            userSearchForm : null,
            disabled : true,
            role_id : null,
        }
    },

    components:
    {
        ReniecFindComponent,
        Multiselect,
    },

    mounted()
    {
        this.modal = new bootstrap.Modal( document.getElementById( `userStoreModal` ) )
        this.form = document.getElementById( `userStoreForm` )
        this.userSearchForm = document.getElementById( `userSearchForm` )
    },

    methods:
    {
        reniecResponse( data )
        {
            if(data.status == 200)
            {
                vuenisimo.clearError( this.userSearchForm )
                vuenisimo.clearError( this.form )
                vuenisimo.setData( this.form, data )
                this.disabled = false
            }
            else if(data.status == 404)
            {
                let error = { errors : {
                    document : `No se encontro el documento.`
                }}
                vuenisimo.setError( this.userSearchForm, error )
                vuenisimo.clearError( this.form )
                vuenisimo.clearData( this.form )
                this.disabled = false
            }

            else if(data.status == 422)
            {
                vuenisimo.clearError( this.form )
                vuenisimo.clearError( this.userSearchForm )
                vuenisimo.clearData( this.form )
                this.disabled = true
            }
        },

        store()
        {
            vuenisimo.clearData( this.userSearchForm )
            vuenisimo.clearData( this.form )
            vuenisimo.clearError( this.form )
            this.role_id = null
            this.disabled = true
            this.modal.show()
        },

        storeEvent( e )
        {
            e.preventDefault()
            vuenisimo.loader( this.form, true )
            vuenisimo.clearError( this.form )
            vuenisimo.processing( this.modal, true )
            let searchForm = vuenisimo.getData( this.userSearchForm )
            let data = vuenisimo.getData( this.form )
            data.role_id = this.role_id
            data.document = searchForm.document
            this.axios.post( `${this.$uri}/user`, data )
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
