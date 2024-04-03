<template>
    <div class="modal fade" id="userStoreModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="modal-title text-sm">
                                <i class="lni lni-circle-plus me-1 fw-bold text-success"></i>
                                Nuevo proyecto
                            </h5>
                        </div>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="project-tab" data-bs-toggle="tab"
                                data-bs-target="#project" type="button" role="tab" aria-controls="project" disabled
                                aria-selected="true">PROYECTO</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" disabled
                                type="button" role="tab" aria-controls="team" aria-selected="false">EQUIPO</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#others"
                                disabled type="button" role="tab" aria-controls="others"
                                aria-selected="false">OTROS</button>
                        </li>
                        <li v-if="isPosincubation()" class="nav-item" role="presentation">
                            <button class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company"
                                disabled type="button" role="tab" aria-controls="company"
                                aria-selected="false">Empresa</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="project" role="tabpanel"
                            aria-labelledby="project-tab">
                            <form id="projectForm" class="position-relative">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Titulo del proyecto (*)</label>
                                        <input type="text" name="title" class="form-control form-control-sm"
                                            autocomplete="new-title">
                                        <p error="title" class="error"></p>
                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">Codigo (*)</label>
                                        <input type="text" name="code" class="form-control form-control-sm"
                                            maxlength="50" autocomplete="new-code">
                                        <p error="code" class="error"></p>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label">Etapa (*)</label>
                                        <select class="form-select form-select-sm" name="stage" v-model="selectedStage">
                                            <option disabled value="" selected>- Seleccione Proceso -</option>
                                            <option v-for="stage in stages" :key="stage.id" :value="stage.id">{{
                            stage.name }}</option>
                                        </select>
                                        <p error="stage" class="error"></p>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label">Categoría (*)</label>
                                        <select class="form-select form-select-sm" name="category">
                                            <option disabled value="" selected>- Seleccione Proceso -</option>
                                            <option v-for="category in categories" :key="category.id"
                                                :value="category.id">{{ category.name }}</option>
                                        </select>
                                        <p error="category" class="error"></p>
                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">Concurso (*)</label>
                                        <select class="form-select form-select-sm" name="contest">
                                            <option disabled value="" selected>- Seleccione Proceso -</option>
                                            <option v-for="contest in contests" :key="contest.id" :value="contest.id">{{
                            contest.name }}</option>
                                        </select>
                                        <p error="contest" class="error"></p>
                                    </div>

                                    <div class="col-2">
                                        <label class="form-label">Presupuesto (*)</label>
                                        <input type="text" name="budget" class="form-control form-control-sm"
                                            maxlength="100" autocomplete="new-budget">
                                        <p error="budget" class="error"></p>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label">Resolución (*)</label>
                                        <input type="text" name="resolution" class="form-control form-control-sm"
                                            maxlength="100" autocomplete="new-resolution">
                                        <p error="resolution" class="error"></p>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label">Emisión de resolución (*)</label>
                                        <input type="date" name="resolutionIssuance"
                                            class="form-control form-control-sm" maxlength="100"
                                            autocomplete="new-resolutionIssuance">
                                        <p error="resolutionIssuance" class="error"></p>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label">Inicio de Cronograma (*)</label>
                                        <input type="date" name="startSchedule" class="form-control form-control-sm"
                                            maxlength="100" autocomplete="new-startSchedule">
                                        <p error="startSchedule" class="error"></p>
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label">Fin de Cronograma (*)</label>
                                        <input type="date" name="endSchedule" class="form-control form-control-sm"
                                            maxlength="100" autocomplete="new-endSchedule">
                                        <p error="endSchedule" class="error"></p>
                                    </div>


                                    <div class="col-12">
                                        <label class="form-label">Objetivo General (*)</label>
                                        <input type="text" name="generalObjective" class="form-control form-control-sm"
                                            autocomplete="new-generalObjective">
                                        <p error="generalObjective" class="error"></p>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Objetivos Especificos (*)</label>
                                        <textarea class="form-control" name="specificObjectives" rows="4"
                                            placeholder="- Objetivo 1&#10;- Objetivo 2"></textarea>
                                        <p error="specificObjectives" class="error"></p>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-12 text-end mt-3">
                                        <button type="button" @click="saveForm('project', 'team-tab')"
                                            class="btn btn-primary btn-sm fs-7 mb-0">Siguiente</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
                            <form id="teamForm" class="position-relative">
                                <div class="col-12">
                                    <label class="form-label">Asesor (*)</label>
                                    <Multiselect v-model="advisor" :options="professors"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="advisor"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Representante (*)</label>
                                    <Multiselect v-model="representative" :options="filterStudents()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="representative"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Integramte 1 (*)</label>
                                    <Multiselect v-model="memberOne" :options="filterStudents()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="memberOne"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Integrante 2 (*)</label>
                                    <Multiselect v-model="memberTwo" :options="filterStudents()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="memberTwo"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Integrante 3</label>
                                    <Multiselect v-model="memberThree" :options="filterStudents()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        :disabled="!(memberOne && memberTwo)" placeholder="- Seleccionar -" />
                                    <p class="error" error="memberThree"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Integrante 4</label>
                                    <Multiselect v-model="memberFour" :options="filterStudents()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        :disabled="!(memberOne && memberTwo && memberThree)"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="memberFour"></p>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-end mt-3">
                                        <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2"
                                            @click="changeTab('project-tab')">Anterior</button>
                                        <button type="button" @click="saveForm('team', 'others-tab')"
                                            class="btn btn-success btn-sm fs-7 mb-0">Siguiente</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">
                            <form id="othersForm" class="position-relative">
                                <div class="col-12">
                                    <label class="form-label">Laboratorio 1</label>
                                    <Multiselect v-model="laboratoryOne" :options="filterLaboratories()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="laboratoryOne"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Laboratorio 2</label>
                                    <Multiselect v-model="laboratoryTwo" :options="filterLaboratories()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="laboratoryTwo"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Laboratorio 3</label>
                                    <Multiselect v-model="laboratoryThree" :options="filterLaboratories()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="laboratoryThree"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Laboratorio 4</label>
                                    <Multiselect v-model="laboratoryFour" :options="filterLaboratories()"
                                        :noResultsText="'Sin resultados'" :searchable="true" :closeOnSelect="true"
                                        placeholder="- Seleccionar -" />
                                    <p class="error" error="laboratoryFour"></p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Observaciones</label>
                                    <textarea class="form-control" name="observation" rows="2"></textarea>
                                    <p error="observation" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Producción y difusión de resultados</label>
                                    <textarea class="form-control" name="production" rows="2"></textarea>
                                    <p error="production" class="error"></p>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-end mt-3">
                                        <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2"
                                            @click="changeTab('team-tab')">Anterior</button>
                                        <button v-if="isPosincubation()" @click="saveForm('others', 'company-tab')"
                                            type="button" class="btn btn-primary btn-sm fs-7 mb-0">
                                            Siguiente
                                        </button>

                                        <button v-else type="button" @click="saveForm('others')"
                                            class="btn btn-success btn-sm fs-7 mb-0">
                                            Guardar
                                        </button>



                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
                            <form id="companyForm" class="position-relative">

                                <div class="col-12">
                                    <label class="form-label">Empresa (*)</label>
                                    <input type="text" name="companyName" class="form-control form-control-sm"
                                        maxlength="50" autocomplete="new-companyName">
                                    <p error="companyName" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Nombre del gerente (*)</label>
                                    <Multiselect v-model="manager" :options="students" :noResultsText="'Sin resultados'"
                                        :searchable="true" :closeOnSelect="true" placeholder="- Seleccionar -" />
                                    <p class="error" error="manager"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Correo electrónico (*)</label>
                                    <input type="email" name="email" class="form-control form-control-sm"
                                        maxlength="100" autocomplete="new-email">
                                    <p error="email" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Fecha (*)</label>
                                    <input type="date" name="date" class="form-control form-control-sm" maxlength="100"
                                        autocomplete="new-date">
                                    <p error="date" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Dirección (*)</label>
                                    <input type="address" name="address" class="form-control form-control-sm"
                                        maxlength="100" autocomplete="new-address">
                                    <p error="address" class="error"></p>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-end mt-3">
                                        <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2"
                                            @click="changeTab('others-tab')">Anterior</button>
                                        <button type="button" class="btn btn-success btn-sm fs-7 mb-0" @click="saveForm('company')">Guardar</button>
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
import vuenisimo from '../../../helper/vuenisimo.js'
import Multiselect from '@vueform/multiselect'

export default
    {

        watch: {
            memberOne(val) {
                if (!val) {
                    this.memberThree = null
                    this.memberFour = null
                }
            },
            memberTwo(val) {
                if (!val) {
                    this.memberThree = null
                    this.memberFour = null
                }
            },

            memberThree(val) {
                if (!val) {
                    this.memberFour = null
                }
            }
        },


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
                modal: null,
                projectForm: null,
                teamForm: null,
                othersForm: null,
                companyForm: null,
                advisor: null,
                representative: null,
                memberOne: null,
                memberTwo: null,
                memberThree: null,
                memberFour: null,
                laboratoryOne: null,
                laboratoryTwo: null,
                laboratoryThree: null,
                laboratoryFour: null,
                manager: null,
                selectedStage: null,
            }
        },

        components:
        {
            Multiselect,
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`userStoreModal`))
            this.projectForm = document.getElementById(`projectForm`)
            this.teamForm = document.getElementById(`teamForm`)
            this.othersForm = document.getElementById(`othersForm`)
            this.companyForm = document.getElementById(`companyForm`)
        },

        methods:
        {
            isPosincubation() {
                return this.stages.find(stage => stage.id === this.selectedStage)?.name === 'Posincubación'
            },

            filterLaboratories() {
                return this.laboratories.filter(laboratory => ![this.laboratoryOne, this.laboratoryTwo, this.laboratoryThree, this.laboratoryFour]
                    .includes(laboratory.value));
            },

            filterStudents() {
                return this.students.filter(student => ![this.representative, this.memberOne, this.memberTwo, this.memberThree, this.memberFour]
                    .includes(student.value));
            },

            store() {
                vuenisimo.clearData(this.projectForm)
                vuenisimo.clearError(this.projectForm)
                vuenisimo.clearData(this.teamForm)
                vuenisimo.clearError(this.teamForm)
                vuenisimo.clearData(this.othersForm)
                vuenisimo.clearError(this.othersForm)
                vuenisimo.clearData(this.companyForm)
                vuenisimo.clearError(this.companyForm)

                this.advisor = null
                this.representative = null
                this.memberOne = null
                this.memberTwo = null
                this.memberThree = null
                this.memberFour = null
                this.laboratoryOne = null
                this.laboratoryTwo = null
                this.laboratoryThree = null
                this.laboratoryFour = null
                this.manager = null
                this.changeTab("project-tab")
                this.modal.show()
            },


            changeTab(idTab) {
                const someTabTriggerEl = document.querySelector('#' + idTab)
                const tab = new bootstrap.Tab(someTabTriggerEl)
                tab.show()
            },

            getData(form) {
                const data = vuenisimo.getData(this[`${form}Form`])
                if (form === 'team') {
                    data.advisor = this.advisor
                    data.representative = this.representative
                    data.memberOne = this.memberOne
                    data.memberTwo = this.memberTwo
                    data.memberThree = this.memberThree
                    data.memberFour = this.memberFour
                }

                if (form === 'others') {
                    data.laboratoryOne = this.laboratoryOne
                    data.laboratoryTwo = this.laboratoryTwo
                    data.laboratoryThree = this.laboratoryThree
                    data.laboratoryFour = this.laboratoryFour
                }

                if (form === 'company') {
                    data.manager = this.manager
                }

                return data
            },

            saveForm(form, nextForm) {

                console.log("asdasd");

                vuenisimo.loader(this[`${form}Form`], true)
                console.log("eeeee");


                this.axios.post(`${this.$uri}/project/validate-data?type=${form}`, this.getData(form))
                    .then(response => {
                        vuenisimo.clearError(this[`${form}Form`])

                        if (nextForm) {
                            this.changeTab(nextForm)
                        } else {

                            const data = {
                                project: this.getData('project'),
                                team: this.getData('team'),
                                others: this.getData('others'),
                            }

                            if (this.isPosincubation()) {
                                data.company = this.getData('company')
                            }

                            vuenisimo.processing(this.modal, true)
                            return this.axios.post(`${this.$uri}/project`, data)
                        }

                    })
                    .then(response => {
                        if (response) {
                            this.modal.hide()
                            this.$emit(`reload`, true)
                            vuenisimo.storeNotification()
                        }
                    })
                    .catch(error => {
                        vuenisimo.clearError(this[`${form}Form`])
                        error.response.data.message = "Revise los datos ingresados.";
                        vuenisimo.error(error.response, this[`${form}Form`])
                    }).finally(() => {
                        vuenisimo.loader(this[`${form}Form`], false)
                    })

            },

        },
    }
</script>
