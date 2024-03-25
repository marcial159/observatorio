<template>
    <div class="col-12">
        <div class="table-size-1">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-th">
                    <tr>
                        <th class="col-3 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `title` )">
                            Titulo
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-6 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `type_project_id` )">
                            Tipo de proyecto
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-6 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `resolution` )">
                            Resolusion
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `short` )">
                            Palabra corta
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `status` )">
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
                        <td class="align-middle text-left animate__animated animate__fadeIn">
                            <h6 class="mb-0 ms-2 text-xs">{{ element.title  }}</h6>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">
                                <span v-if="element.type_project_id == 1" style="width: 100px;" class="badge bg-success">Inv.Docente</span>
                                <span v-else style="width: 100px;"
                                    class="badge bg-secondary text-dark">Inv. Estudiante</span>
                            </small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.resolution  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.short  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">
                                <span v-if="element.status == 1" style="width: 50px;" class="badge bg-success">Activo</span>
                                <span v-else style="width: 100px;"
                                    class="badge bg-danger">Inactivo</span>
                            </small>
                        </td>
                        <td class="align-middle text-center" v-show="keys.includes( `announcement.update` ) || keys.includes( `announcement.destroy` )">
                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn" data-bs-toggle="dropdown" id="dropMenu">
                                <i class="lni lni-grid-alt fw-bold"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropMenu">
                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes( `announcement.update` )" @click="$emit( `update`, element )">
                                        <i class="lni lni-pencil-alt me-2"></i>Modificar
                                    </a>
                                </li>
                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes( `announcement.destroy` )" @click="$emit( `destroy`, element )">
                                        <i class="lni lni-trash-can me-2"></i>Eliminar
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

<script>
import { mapState } from 'vuex'

export default
{
    props:
    {
        data : Object,
    },

    computed: mapState([ `keys` ]),
}
</script>