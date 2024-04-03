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
                element: null,
            }
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`itemUpdateModal`))
            this.form = document.getElementById(`itemFormUpdate`)
        },

        methods:
        {
            filterItems() {
                if (this.projectItems) {
                    return this.items?.filter(item => !this.projectItems.some(projectItem => projectItem.item_id === item.id && projectItem.item_id !== this.element?.item_id))
                } else {
                    return this.items
                }
            },


            update(element) {
                this.element = element
                vuenisimo.loader(this.form, true)
                vuenisimo.clearData(this.form)
                vuenisimo.clearError(this.form)
                this.modal.show()

                this.axios.get(`${this.$uri}/project-item/${element.id}`)
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

                data.projectId = this.projectId

                this.axios.put(`${this.$uri}/project-item/${this.element.id}`, data)
                    .then(response => {
                        this.modal.hide()
                        this.$emit('row', response.data)
                        // this.$emit(`reload`, true)

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
