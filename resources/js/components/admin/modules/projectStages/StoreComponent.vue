<template>
    <div class="modal fade" id="stageStoreModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="modal-title text-sm">
                                <i class="lni lni-circle-plus me-1 fw-bold text-success"></i>
                                Nuevo estado de proyecto
                            </h5>
                        </div>
                    </div>
                    <form @submit="storeEvent" id="stageForm" class="position-relative">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label">Name (*)</label>
                                <input type="text" name="name" class="form-control form-control-sm"
                                    autocomplete="new-text">
                                <p error="name" class="error"></p>
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
            }
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`stageStoreModal`))
            this.form = document.getElementById(`stageForm`)
        },

        methods:
        {
            store() {
                vuenisimo.clearData(this.form)
                vuenisimo.clearError(this.form)
                this.modal.show()
            },

            storeEvent(e) {
                e.preventDefault()
                vuenisimo.loader(this.form, true)
                vuenisimo.clearError(this.form)
                vuenisimo.processing(this.modal, true)
                let data = vuenisimo.getData(this.form)

                this.axios.post(`${this.$uri}/project-stage`, data)
                    .then(response => {
                        vuenisimo.clearData(this.form)
                        this.modal.hide()
                        this.$emit(`reload`, true)
                        vuenisimo.storeNotification()
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
