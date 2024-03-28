<template>
    <div class="col-12">
        <div class="table-size-1" style="overflow-x: auto;">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-th">
                    <tr>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `name`)">
                            Nombre
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button">
                            Descripción
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `type`)">
                            Tipo
                            <i class="lni lni-arrows-vertical"></i>
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button"
                            @click="$emit(`order`, `status`)">
                            Estado
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
                            <small class="mb-0 text-xs">{{ element.name }}</small>
                        </td>

                        <td class="align-middle animate__animated animate__fadeIn" :title="element.description">
                            <small class="mb-0 text-xs">
                                <span v-if="element.description?.length <= 60">{{ element.description }}</span>
                                <span v-else>{{ element.description?.substring(0, 60) }}...</span>
                            </small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">
                                <span v-if="element.type === 'Investigación'" style="width: 80px;" class="badge bg-info">Investigacion</span>
                                <span v-else-if="element.type === 'Incubadora'" style="width: 70px;" class="badge bg-secondary">Incubadora</span>
                                <span v-else-if="element.type === 'General'" style="width: 50px;" class="badge bg-primary">General</span>                                
                            </small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">
                                <span v-if="element.status == 'Activo'" style="width: 50px;" class="badge bg-success">Activo</span>
                                <span v-else style="width: 50px;" class="badge bg-danger">Inactivo</span>
                            </small>
                        </td>

                        <td class="align-middle text-center"
                            v-show="keys.includes(`user.update`) || keys.includes(`user.destroy`) || keys.includes(`user.file`)">
                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn"
                                data-bs-toggle="dropdown" id="dropMenu">
                                <i class="lni lni-grid-alt fw-bold"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropMenu">

                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes(`user.update`)"
                                        @click="$emit(`update`, element)">
                                        <i class="fa fa-pencil-square-o me-2" aria-hidden="true"></i>Modificar
                                    </a>
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
