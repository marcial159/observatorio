<template>
    <div class="modal fade" id="itemUpdateModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="modal-title text-sm d-inline-block">
                                <i class="lni lni-pencil-alt me-1 fw-bold text-success"></i>
                                Modificar Rubro
                            </h5>
                        </div>
                    </div>
                    <form @submit="updateEvent" id="itemFormUpdate" class="position-relative">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label">Name (*)</label>
                                <input type="text" name="name" class="form-control form-control-sm"
                                    autocomplete="new-text">
                                <p error="name" class="error"></p>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Tipo (*)</label>
                                <input type="text" name="type" class="form-control form-control-sm"
                                    autocomplete="new-text">
                                <!--<select name="type" class="form-control form-control-sm">
                                    <option disabled value="" selected>- Seleccione un tipo -</option>
                                    <option value="3">Incubadora</option>
                                    <option value="2">Investigacion</option>
                                    <option value="1">General</option>
                                </select>
                                <p error="type" class="error"></p>-->
                            </div>

                            <div class="col-12">
                                <label class="form-label">Estado (*)</label>
                                <select name="status" class="form-control form-control-sm">
                                    <option disabled value="" selected>- Seleccione un estado -</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <p error="status" class="error"></p>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Descripción</label>
                                <textarea name="description" class="form-control form-control-sm" rows="2"
                                    autocomplete="new-text"></textarea>
                                <p error="description" class="error"></p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 text-end mt-3">
                                <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2"
                                    data-bs-dismiss="modal">Cancelar</button>
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

export default
    {
        data() {
            return {
                modal: null,
                form: null,
                element: null,
            }
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`itemUpdateModal`))
            this.form = document.getElementById(`itemFormUpdate`)
        },

        methods:
        {
            update(element) {
                this.element = element
                vuenisimo.loader(this.form, true)
                vuenisimo.clearData(this.form)
                vuenisimo.clearError(this.form)
                this.modal.show()

                this.axios.get(`${this.$uri}/item/${element.id}`)
                    .then(response => {
                        vuenisimo.setData(this.form, response.data)
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.form, false)
                    })


            },

            updateEvent(e) {
                e.preventDefault()
                vuenisimo.loader(this.form, true)
                vuenisimo.clearError(this.form)
                vuenisimo.processing(this.modal, true)
                let data = vuenisimo.getData(this.form)

                this.axios.put(`${this.$uri}/item/${this.element.id}`, data)
                    .then(response => {
                        this.modal.hide()
                        this.$emit('row', response.data)
                        vuenisimo.updateNotification()
                    })
                    .catch(error => {
                        vuenisimo.error(error.response, this.form)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.form, false)
                        vuenisimo.processing(this.modal, false)
                    })
            }
        },
    }
</script>
