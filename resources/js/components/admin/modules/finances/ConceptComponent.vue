<template>
    <div class="modal fade" id="projectConceptsModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div :class="'modal-dialog ' + modalSize">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="modal-title text-sm">
                                <i class="lni lni-file me-1 fw-bold text-success"></i>
                                Gastos detallados
                            </h5>
                        </div>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: none">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="list-concepts-tab" data-bs-toggle="tab"
                                data-bs-target="#project-files" type="button" role="tab" aria-controls="project-files"
                                aria-selected="true">
                                Listar
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="form-tab" data-bs-toggle="tab" data-bs-target="#form-file"
                                type="button" role="tab" aria-controls="form-file" aria-selected="false">
                                Registrar
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="project-files" role="tabpanel"
                            aria-labelledby="list-concepts-tab">
                            <div class="row">
                                <div class="col-8 text-start mb-4 d-flex align-items-center">
                                    <span class="font-weight-bold">TOTAL: </span>
                                    <span class="text-success">{{ this.statistics?.total }}</span>
                                    <span class="ms-3 font-weight-bold">SALDO:</span>
                                    <span class="text-danger">{{ this.statistics?.balance }}</span>
                                    <span class="ms-3 font-weight-bold">EJECUTADO: </span>
                                    <span class="text-primary">{{ this.statistics?.execution }}</span>
                                    <span class="ms-3 font-weight-bold">% EJECUCIÓN:</span>
                                    <span class="text-info">{{ this.statistics?.executionPercentage }} %</span>
                                </div>

                                <div class="col-4 text-end mb-4">
                                    <button type="button" class="btn btn-sm btn-success mb-0"
                                        @click="changeTab('form-tab')">
                                        <i class="lni lni-circle-plus me-1 fs-7"></i>
                                        Nuevo
                                    </button>
                                </div>
                            </div>

                            <table class="table table-hover align-items-center mb-0 mt-1">
                                <thead class="bg-th">
                                    <tr>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="Concepto: Descripción del gasto">Concepto</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="N° de SIAF: Número de identificación del gasto en el Sistema Integrado de Administración Financiera">
                                            N° SIAF</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="N° de Pedido: Número asignado al pedido de compra">N° Pedido</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="N° de Orden: Número de orden de compra">N° Orden</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="N° de Pecosa: Número de pecosa asociado al gasto">N° Pecosa</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="Detalle: Descripción detallada del gasto">Detalle</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="Situación: Estado actual del gasto">Situación</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="Monto Ejecutado: Cantidad de dinero gastada o desembolsada">Monto
                                            Ejec.</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center"
                                            title="Acción: Acción a realizar sobre el gasto">Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="concept in concepts" :key="concept.id">
                                        <td class="align-middle animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{
            concept.description
        }}</small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{
                concept.siafNumber
            }}</small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{
                concept.trackingNumber
            }}</small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{
                concept.orderNumber
            }}</small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{
                concept.pecosaNumber
                                                }}</small>
                                        </td>

                                        <td style="
                                                max-width: 150px;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                            " class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">
                                                <span :title="concept.details">{{ concept.details }}</span>
                                            </small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{ concept.situation }}</small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">S/ {{ concept.executedAmount }}</small>
                                        </td>

                                        <td class="align-middle text-center">
                                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn"
                                                data-bs-toggle="dropdown" id="dropMenuFile">
                                                <i class="lni lni-grid-alt fw-bold"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropMenuFile">
                                                <li class="cursor-pointer">
                                                    <a class="dropdown-item" @click="update(concept.id)">
                                                        <i class="fa fa-pencil-square-o me-2"
                                                            aria-hidden="true"></i>Editar </a>
                                                </li>

                                                <li class="cursor-pointer">
                                                    <a class="dropdown-item" @click="conceptDelete(concept.id)">
                                                        <i class="fa fa-trash-o me-2" aria-hidden="true"></i>Eliminar
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr v-if="concepts && concepts?.length == 0">
                                        <td colspan="9"
                                            class="align-middle text-left animate__animated animate__fadeIn text-center">
                                            <small> - Sin registros - </small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="form-file" role="tabpanel" aria-labelledby="form-file-tab">
                            <form @submit="sendForm" id="conceptForm" class="position-relative row">
                                <div class="col-12">
                                    <label class="form-label">Concepto (*)</label>
                                    <input type="text" name="description" class="form-control form-control-sm"
                                        autocomplete="new-description" />
                                    <p error="description" class="error"></p>
                                </div>

                                <div class="col-3">
                                    <label class="form-label">N° SIAF</label>
                                    <input type="text" name="siafNumber" class="form-control form-control-sm"
                                        autocomplete="new-siafNumber" />
                                    <p error="siafNumber" class="error"></p>
                                </div>

                                <div class="col-3">
                                    <label class="form-label">N° Pedido</label>
                                    <input type="text" name="trackingNumber" class="form-control form-control-sm"
                                        autocomplete="new-trackingNumber" />
                                    <p error="trackingNumber" class="error"></p>
                                </div>

                                <div class="col-3">
                                    <label class="form-label">N° Orden</label>
                                    <input type="text" name="orderNumber" class="form-control form-control-sm"
                                        autocomplete="new-orderNumber" />
                                    <p error="orderNumber" class="error"></p>
                                </div>

                                <div class="col-3">
                                    <label class="form-label">N° Pecosa</label>
                                    <input type="text" name="pecosaNumber" class="form-control form-control-sm"
                                        autocomplete="new-pecosaNumber" />
                                    <p error="pecosaNumber" class="error"></p>
                                </div>
                                <div class="col-9">
                                    <label class="form-label">Situación (*)</label>
                                    <select name="situation" class="form-select form-select-sm"
                                        autocomplete="new-situation">
                                        <option value="">Seleccionar</option>
                                        <option value="Aprobado">
                                            Aprobado
                                        </option>
                                        <option value="En proceso de entrega">
                                            En proceso de entrega
                                        </option>
                                        <option value="Finalizado">
                                            Finalizado
                                        </option>
                                        <option value="En revisión">
                                            En revisión
                                        </option>
                                        <option value="Pendiente de aprobación">
                                            Pendiente de aprobación
                                        </option>
                                        <option value="En proceso de liquidación">
                                            En proceso de liquidación
                                        </option>
                                        <option value="Pendiente de rendición de cuentas">
                                            Pendiente de rendición de cuentas
                                        </option>
                                        <option value="Cancelado">
                                            Cancelado
                                        </option>
                                        <option value="Rechazado">
                                            Rechazado
                                        </option>
                                        <option value="En espera de autorización">
                                            En espera de autorización
                                        </option>
                                        <option value="En trámite administrativo">
                                            En trámite administrativo
                                        </option>
                                        <option value="En curso de ejecución">
                                            En curso de ejecución
                                        </option>
                                        <option value="Suspendido temporalmente">
                                            Suspendido temporalmente
                                        </option>
                                        <option value="En evaluación">
                                            En evaluación
                                        </option>
                                        <option value="Pendiente de pago">
                                            Pendiente de pago
                                        </option>
                                        <option value="Cerrado">Cerrado</option>
                                        <option value="En disputa">
                                            En disputa
                                        </option>
                                        <option value="En espera de documentación adicional">
                                            En espera de documentación adicional
                                        </option>
                                        <option value="En análisis financiero">
                                            En análisis financiero
                                        </option>
                                        <option value="En proceso de auditoría">
                                            En proceso de auditoría
                                        </option>
                                    </select>
                                    <p error="situation" class="error"></p>
                                </div>

                                <div class="col-3">
                                    <label class="form-label">Monto Ej. (*)</label>
                                    <input type="text" name="executedAmount" class="form-control form-control-sm"
                                        autocomplete="new-executedAmount" />
                                    <p error="executedAmount" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Detalle (*)</label>
                                    <input type="text" name="details" class="form-control form-control-sm"
                                        autocomplete="new-details" />
                                    <p error="details" class="error"></p>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-end mt-3">
                                        <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2" @click="
            changeTab('list-concepts-tab')
                                            ">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-success btn-sm fs-7 mb-0">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import { isNull } from 'lodash'
import vuenisimo from '../../../helper/vuenisimo.js'

export default
    {
        props:
        {
            categories: Array,
            stages: Array,
            contests: Array,
            professors: Array,
            laboratories: Array,
            students: Array,
        },

        data() {
            return {
                element: null,
                modal: null,
                conceptForm: null,
                concepts: [],
                isEdit: false,
                statistics: {},
                modalSize: 'modal-xl',
            }
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`projectConceptsModal`))
            this.conceptForm = document.getElementById(`conceptForm`)
        },

        methods:
        {

            sendForm(e) {
                e.preventDefault()
                if (this.idEdit) {
                    this.conceptFormUpdate()
                } else {
                    this.conceptFormSubmit()
                }
            },

            concept(element) {

                this.element = element
                vuenisimo.clearData(this.conceptForm)

                vuenisimo.clearError(this.conceptForm)
                this.changeTab("list-concepts-tab")
                this.loadConcepts()

                this.idEdit = null

                this.modal.show()
            },

            loadConcepts() {
                this.axios.post(`${this.$uri}/concept/list`, { projectItem: this.element.id })
                    .then(response => {
                        this.concepts = response.data.list
                        this.statistics = response.data.statistics
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
            },


            changeTab(idTab) {
                const someTabTriggerEl = document.querySelector('#' + idTab)
                const tab = new bootstrap.Tab(someTabTriggerEl)
                tab.show()
                if (idTab === 'list-concepts-tab') {
                    this.idEdit = null
                    vuenisimo.clearData(this.conceptForm)
                    vuenisimo.clearError(this.conceptForm)
                    setTimeout(() => {
                        this.modalSize = 'modal-xl'
                    }, 100);
                } else {
                    setTimeout(() => {
                        this.modalSize = ''
                    }, 100);
                }
            },

            update(id) {
                this.axios.get(`${this.$uri}/concept/${id}`)
                    .then(response => {
                        this.idEdit = id
                        this.changeTab("form-tab")
                        vuenisimo.setData(this.conceptForm, response.data)
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.conceptForm, false)
                    })

            },

            conceptFormUpdate() {

                console.log("sdasdasdsa");

                const data = vuenisimo.getData(this.conceptForm)

                vuenisimo.loader(this.conceptForm, true)
                vuenisimo.clearError(this.conceptForm)
                vuenisimo.processing(this.modal, true)

                this.axios.put(`${this.$uri}/concept/${this.idEdit}`, data)
                    .then(response => {
                        vuenisimo.storeNotification()
                        vuenisimo.clearData(this.conceptForm)
                        vuenisimo.clearError(this.conceptForm)
                        this.loadConcepts()
                        this.changeTab("list-concepts-tab")

                        this.$emit(`reload`, true)

                    })
                    .catch(error => {
                        vuenisimo.error(error.response, this.conceptForm)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.conceptForm, false)
                        vuenisimo.processing(this.modal, false)
                    })

            },

            conceptFormSubmit() {

                const data = vuenisimo.getData(this.conceptForm)

                data.projectItem = this.element.id

                vuenisimo.loader(this.conceptForm, true)
                vuenisimo.clearError(this.conceptForm)
                vuenisimo.processing(this.modal, true)

                this.axios.post(`${this.$uri}/concept`, data)
                    .then(response => {
                        vuenisimo.storeNotification()
                        vuenisimo.clearData(this.conceptForm)
                        vuenisimo.clearError(this.conceptForm)
                        this.loadConcepts()
                        this.changeTab("list-concepts-tab")
                        this.$emit(`reload`, true)

                    })
                    .catch(error => {
                        vuenisimo.error(error.response, this.conceptForm)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.conceptForm, false)
                        vuenisimo.processing(this.modal, false)
                    })
            },

            conceptDelete(id) {
                vuenisimo.loader(this.conceptForm, true)
                this.axios.delete(`${this.$uri}/concept/${id}`)
                    .then(response => {
                        this.loadConcepts()
                        vuenisimo.destroyNotification()
                        this.$emit(`reload`, true)

                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.conceptForm, false)
                    })
            },

        },
    }
</script>
