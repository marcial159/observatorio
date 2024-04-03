<template>
    <div class="col-12">
        <div class="table-size-1" style="overflow-x: auto;">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-th">
                    <tr>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `code`)">
                            Codigo
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-3 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `title`)">
                            Titulo
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-3 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `representative`)">
                            Representante del equipo
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `status`)">
                            Estado
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `budget`)">
                            Monto
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `contest`)">
                            Concurso
                            <i class="lni lni-arrows-vertical"></i>
                        </th>


                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `stage`)">
                            Etapa
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `start_schedule`)">
                            F. lanzamiento
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data?.length > 0" v-for="( element, index ) in data" :key="index">

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.code }}</small>
                        </td>

                        <td class="align-middle animate__animated animate__fadeIn" :title="element.title">
                            <small class="mb-0 text-xs">
                                <span v-if="element.title.length <= 32">{{ element.title }}</span>
                                <span v-else>{{ element.title.substring(0, 32) }}...</span>
                            </small>
                        </td>

                        <td class="align-middle animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.representative }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">
                                <span v-if="element.status === 'Activo'" style="width: 50px;"
                                    class="badge bg-success">Activo</span>
                                <span v-else-if="element.status === 'Inactivo'" style="width: 50px;"
                                    class="badge bg-danger">Inactivo</span>
                            </small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.budget }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.contest.name }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">
                                <span style="width: 80px;" v-if="element.project_stage.name === 'Preincubación'"
                                    class="badge bg-primary">{{ element.project_stage.name }}</span>
                                <span style="width: 80px;" v-else-if="element.project_stage.name === 'Incubación'"
                                    class="badge bg-warning">{{ element.project_stage.name }}</span>
                                <span style="width: 80px;" v-else-if="element.project_stage.name === 'Posincubación'"
                                    class="badge bg-success">{{ element.project_stage.name }}</span>
                                <span style="width: 80px;" v-else>{{ element.project_stage.name }}</span>
                            </small>
                        </td>


                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.start_schedule.substring(0, 10) }}</small>
                        </td>

                        <td class="align-middle text-center"
                            v-show="keys.includes(`user.update`) || keys.includes(`user.destroy`) || keys.includes(`user.file`)">
                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn"
                                data-bs-toggle="dropdown" id="dropMenu">
                                <i class="lni lni-grid-alt fw-bold"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropMenu">

                                <li class="cursor-pointer">
                                    <a class="dropdown-item" @click="$emit(`report`, element)">
                                        <i class="fa fa-eye me-2" aria-hidden="true"></i>Ver
                                    </a>
                                </li>

                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes(`user.update`)"
                                        @click="$emit(`update`, element)">
                                        <i class="fa fa-pencil-square-o me-2" aria-hidden="true"></i>Modificar
                                    </a>
                                </li>

                                <li class="cursor-pointer">
                                    <a class="dropdown-item" @click="$emit(`file`, element)">
                                        <i class="fa fa-file me-2" aria-hidden="true"></i>Archivos
                                    </a>
                                </li>

                                <li class="cursor-pointer">
                                    <a class="dropdown-item" @click="$emit(`monitor`, element)">
                                        <i class="fa fa-desktop me-2" aria-hidden="true"></i>monitor
                                    </a>
                                </li>

                                <li class="cursor-pointer">
                                    <router-link :to="`/admin/projects/finances/${element.code}`" class="dropdown-item">
                                        <i class="fa fa-tags me-2" aria-hidden="true"></i>Rubros
                                    </router-link>
                                </li>

                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes(`user.destroy`)"
                                        @click="$emit(`destroy`, element)">
                                        <i class="fa fa-trash-o me-2" aria-hidden="true"></i>Eliminar
                                    </a>
                                </li>

                            </ul>
                        </td>
                    </tr>
                    <tr v-if="data && data?.length == 0">
                        <td colspan="5" class="align-middle text-left animate__animated animate__fadeIn text-center">
                            <small>
                                - Sin registros -
                            </small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script lang="js">
import { mapState } from 'vuex'

export default
    {
        props:
        {
            data: Object,
        },

        computed: mapState([`keys`]),
    }
</script>
