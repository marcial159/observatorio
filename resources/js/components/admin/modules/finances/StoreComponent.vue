<template>
    <div class="modal fade" id="itemStoreModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="modal-title text-sm">
                                <i class="lni lni-circle-plus me-1 fw-bold text-success"></i>
                                Nuevo Rubro
                            </h5>
                        </div>
                    </div>
                    <form @submit="storeEvent" id="itemForm" class="position-relative">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label">Rubro (*)</label>
                                <select class="form-select form-select-sm" name="item">
                                    <option disabled value="" selected>- Seleccione un rubro -</option>
                                    <option v-for="item in filterItems()" :key="item.id" :value="item.id">{{ item.name
                                        }}
                                    </option>
                                </select>
                                <p error="item" class="error"></p>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Financiamiento (*)</label>
                                <input type="text" name="amount" class="form-control form-control-sm"
                                    autocomplete="new-text">
                                <p error="amount" class="error"></p>
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
        props:
        {
            items: Array,
            projectId: Number,
            projectItems: Array,
        },

        data() {
            return {
                modal: null,
                form: null,
                userSearchForm: null,
                disabled: true,
                role_id: null,
            }
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`itemStoreModal`))
            this.form = document.getElementById(`itemForm`)
        },

        methods:
        {
            filterItems() {
                if (this.projectItems) {
                    return this.items?.filter(item => !this.projectItems.some(projectItem => projectItem.item_id === item.id))
                } else {
                    return this.items
                }
            },


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
                data.projectId = this.projectId

                this.axios.post(`${this.$uri}/project-item`, data)
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
