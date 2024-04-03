<template>
    <div class="modal fade" id="projectFileModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-6">
                            <h5 class="modal-title text-sm">
                                <i class="lni lni-file me-1 fw-bold text-success"></i>
                                Archivos del proyecto de investigacion
                            </h5>
                        </div>

                        <div v-if="setting.tab === 'project-files-tab'" class="col-6 text-end">
                            <button type="button" class="btn btn-sm btn-success mb-0"
                                @click="changeTab('form-file-tab')">
                                <i class="lni lni-circle-plus me-1 fs-7"></i>
                                Nuevo
                            </button>
                        </div>

                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: none;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="project-files-tab" data-bs-toggle="tab"
                                data-bs-target="#project-files" type="button" role="tab" aria-controls="project-files"
                                aria-selected="true">Almacen</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="form-file-tab" data-bs-toggle="tab" data-bs-target="#form-file"
                                type="button" role="tab" aria-controls="form-file"
                                aria-selected="false">Guardar</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="project-files" role="tabpanel"
                            aria-labelledby="project-files-tab">
                            <div class="col-12">
                                <label class="form-label">Tipo de archivo</label>
                                <select class="form-select form-select-sm" v-model="filterType">
                                    <option value="" selected>- Todos -</option>
                                    <option value="Informes">Informes</option>
                                    <option value="Modelos">Modelos</option>
                                    <option value="Bauchers">Bauchers</option>
                                    <option value="Solicitudes">Solicitudes</option>
                                    <option value="Cartas">Cartas</option>
                                    <option value="Solicitud para dejar el proyecto">Solicitud de abandono de proyecto</option>
                                    <option value="Cambios en el equipo">Cambios de integrante</option>
                                    <option value="Cambios de asesor">Cambios de asesor</option>
                                    <option value="Avances">Avances</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>


                            <table class="table table-hover align-items-center mb-0 mt-1">
                                <thead class="bg-th">
                                    <tr>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center">Tipo
                                        </th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center">
                                            Descripción</th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center">Emisión
                                        </th>
                                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center">Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="file in filterFiles()" :key="file.id">
                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{ file.type }}</small>
                                        </td>

                                        <td class="align-middle animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{ file.description }}</small>
                                        </td>

                                        <td class="align-middle text-center animate__animated animate__fadeIn">
                                            <small class="mb-0 text-xs">{{ file.issue }}</small>
                                        </td>

                                        <td class="align-middle text-center">
                                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn"
                                                data-bs-toggle="dropdown" id="dropMenuFile">
                                                <i class="lni lni-grid-alt fw-bold"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropMenuFile">
                                                <li class="cursor-pointer">
                                                    <a class="dropdown-item"
                                                        :href="`/${file.file_path.replace('public', 'storage')}`"
                                                        target="_blank">
                                                        <i class="fa fa-eye me-2" aria-hidden="true"></i>Ver
                                                    </a>
                                                </li>

                                                <li class="cursor-pointer">
                                                    <a class="dropdown-item" @click="update(file.id)">
                                                        <i class="fa fa-pencil-square-o me-2"
                                                            aria-hidden="true"></i>Editar
                                                    </a>
                                                </li>

                                                <li class="cursor-pointer">
                                                    <a class="dropdown-item" @click="fileDelete(file.id)">
                                                        <i class="fa fa-trash-o me-2" aria-hidden="true"></i>Eliminar
                                                    </a>
                                                </li>

                                            </ul>
                                        </td>


                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="form-file" role="tabpanel" aria-labelledby="form-file-tab">
                            <form @submit="sendForm" id="fileForm" class="position-relative">
                                <div class="col-12">
                                    <label class="form-label">Tipo(*)</label>
                                    <select class="form-select form-select-sm" name="type">
                                        <option disabled value="" selected>- Seleccione el tipo -</option>
                                        <option value="Informes">Informes</option>
                                        <option value="Modelos">Modelos</option>
                                        <option value="Bauchers">Bauchers</option>
                                        <option value="Solicitudes">Solicitudes</option>
                                        <option value="Cartas">Cartas</option>
                                        <option value="Solicitud para dejar el proyecto">Solicitud de abandono de proyecto</option>
                                        <option value="Cambios en el equipo">Cambios en el equipo</option>
                                        <option value="Cambios de asesor">Cambios de asesor</option>
                                        <option value="Avances">Avances</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                    <p error="type" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Descripción (*)</label>
                                    <textarea class="form-control" name="description" rows="2"></textarea>
                                    <p error="description" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Emisión (*)</label>
                                    <input type="date" name="issue" class="form-control form-control-sm"
                                        autocomplete="new-issue">
                                    <p error="issue" class="error"></p>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Archivo (*)</label>
                                    <input type="file" name="file" accept=".pdf" class="form-control form-control-sm"
                                        autocomplete="new-file">
                                    <p error="file" class="error"></p>
                                </div>


                                <div class="row">
                                    <div class="col-12 text-end mt-3">
                                        <button type="button" class="btn btn-dark btn-sm fs-7 mb-0 me-2"
                                            @click="changeTab('project-files-tab')">Cancelar</button>
                                        <button type="submit" class="btn btn-success btn-sm fs-7 mb-0">Guardar</button>
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
                fileFrorm: null,
                filterType: null,
                files: [],
                setting: {
                    tab: "project-files-tab",
                    isEdit: null,
                }
            }
        },

        mounted() {
            this.modal = new bootstrap.Modal(document.getElementById(`projectFileModal`))
            this.fileForm = document.getElementById(`fileForm`)
        },

        methods:
        {
            sendForm(e) {
                e.preventDefault()
                if (this.setting.idEdit) {
                    this.fileFormUpdate()
                } else {
                    this.fileFormSubmit()
                }
            },


            file(element) {
                this.element = element
                vuenisimo.clearData(this.fileForm)

                vuenisimo.clearError(this.fileForm)
                this.changeTab("project-files-tab")
                this.loadFiles()

                this.modal.show()
            },

            filterFiles() {
                if (!this.filterType) {
                    return this.files
                } else {
                    return this.files.filter(file => file.type.includes(this.filterType));
                }
            },

            loadFiles() {
                this.axios.post(`${this.$uri}/project-file/list`, { projectId: this.element.id })
                    .then(response => {
                        this.files = response.data
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
            },


            changeTab(idTab) {

                this.setting.tab = idTab
                if (idTab === "project-files-tab") {
                    this.setting.idEdit = null
                    vuenisimo.clearData(this.fileForm)
                    vuenisimo.clearError(this.fileForm)
                }

                const someTabTriggerEl = document.querySelector('#' + idTab)
                const tab = new bootstrap.Tab(someTabTriggerEl)
                tab.show()
            },

            fileFormSubmit() {
                const formData = new FormData(this.fileForm)
                formData.append(`projectId`, this.element.id)

                vuenisimo.loader(this.fileForm, true)
                vuenisimo.clearError(this.fileForm)
                vuenisimo.processing(this.modal, true)

                this.axios.post(`${this.$uri}/project-file`, formData)
                    .then(response => {
                        vuenisimo.storeNotification()
                        vuenisimo.clearData(this.fileForm)
                        vuenisimo.clearError(this.fileForm)
                        this.loadFiles()
                        this.changeTab("project-files-tab")
                    })
                    .catch(error => {
                        vuenisimo.error(error.response, this.fileForm)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.fileForm, false)
                        vuenisimo.processing(this.modal, false)
                    })
            },

            update(id) {

                let filename = null

                this.axios.get(`${this.$uri}/project-file/${id}`)
                    .then(response => {
                        this.setting.idEdit = id
                        this.changeTab("form-file-tab")
                        vuenisimo.setData(this.fileForm, response.data)

                        filename = response.data.file_path.replace('public/files/', '')
                        this.setting.idEdit = id

                        return this.axios.get('/' + response.data.file_path.replace('public', 'storage'), { responseType: 'blob' });
                    })
                    .then(secondResponse => {
                        console.log(secondResponse.data);
                        const file = new File([secondResponse.data], filename, { type: secondResponse.data.type });
                        const fileList = new DataTransfer()
                        fileList.items.add(file)
                        this.fileForm.querySelector('input[type="file"]').files = fileList.files
                    })

                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.fileForm, false)
                    })

            },

            fileFormUpdate() {
                const formData = new FormData(this.fileForm)
                formData.append(`projectId`, this.element.id)

                vuenisimo.loader(this.fileForm, true)
                vuenisimo.clearError(this.fileForm)
                vuenisimo.processing(this.modal, true)

                this.axios.post(`${this.$uri}/project-file/update/${this.setting.idEdit}`, formData)
                    .then(response => {
                        vuenisimo.storeNotification()
                        vuenisimo.clearData(this.fileForm)
                        vuenisimo.clearError(this.fileForm)
                        this.loadFiles()
                        this.changeTab("project-files-tab")
                    })
                    .catch(error => {
                        vuenisimo.error(error.response, this.fileForm)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.fileForm, false)
                        vuenisimo.processing(this.modal, false)
                    })
            },

            fileDelete(id) {
                vuenisimo.loader(this.fileForm, true)
                this.axios.delete(`${this.$uri}/project-file/${id}`)
                    .then(response => {
                        this.loadFiles()
                        vuenisimo.destroyNotification()
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.fileForm, false)
                    })
            },

        },
    }
</script>
