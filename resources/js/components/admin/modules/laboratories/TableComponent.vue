<template>
    <div class="col-12">
        <div class="table-size-1">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-th">
                    <tr>
                        <th class="col-3 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `name` )">
                            Nombre
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-6 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `ambient` )">
                            Asignamiento
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-6 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `ásignament_id` )">
                            Ambiente
                            <i class="lni lni-arrows-vertical"></i>
                        </th>                        
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `created_at` )">
                            Creado
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `updated_at` )">
                            Actualizado
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
                            <h6 class="mb-0 ms-2 text-xs">{{ element.name  }}</h6>
                        </td>
                        <td class="align-middle text-left animate__animated animate__fadeIn">
                            <h6 class="mb-0 ms-2 text-xs">{{ element.asignament_id  }}</h6>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.ambient  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.created_at  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.updated_at  }}</small>
                        </td>
                        <td class="align-middle text-center" v-show="keys.includes( `laboratory.update` ) || keys.includes( `laboratory.destroy` )">
                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn" data-bs-toggle="dropdown" id="dropMenu">
                                <i class="lni lni-grid-alt fw-bold"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropMenu">
                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes( `laboratory.update` )" @click="$emit( `update`, element )">
                                        <i class="lni lni-pencil-alt me-2"></i>Modificar
                                    </a>
                                </li>
                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes( `laboratory.destroy` )" @click="$emit( `destroy`, element )">
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