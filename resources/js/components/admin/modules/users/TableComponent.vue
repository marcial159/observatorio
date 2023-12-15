<template>
    <div class="col-12">
        <div class="table-size-1">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-th">
                    <tr>
                        <th class="col-3 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `firstname` )">
                            Usuario
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `email` )">
                            Email
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-6 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `phone` )">
                            Celular
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `created_at` )">
                            Creación
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" @click="$emit( `order`, `updated_at` )">
                            Modificación
                            <i class="lni lni-arrows-vertical"></i>
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data?.length > 0" v-for="( element, index ) in data" :key="index">
                        <td class="align-middle text-start animate__animated animate__fadeIn">
                            <div class="d-flex px-2 py-1">
                                <img class="avatar avatar-sm rounded-circle me-2" :src="element.avatar ? element.avatar : `../assets/img/user.png`" alt="">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">{{ element.firstname }} {{ element.lastname  }}</h6>
                                    <small class="mb-0 text-xs">{{ element.role ? element.role[0].name : `Ninguno`  }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.email  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.phone  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.created_at  }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.updated_at  }}</small>
                        </td>
                        <td class="align-middle text-center" v-show="keys.includes( `user.update` ) || keys.includes( `user.destroy` )">
                            <a class="btn btn-sm px-2 py-1 mb-1 mb-0 btn-menu animate__animated animate__fadeIn" data-bs-toggle="dropdown" id="dropMenu">
                                <i class="lni lni-grid-alt fw-bold"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropMenu">
                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes( `user.update` )" @click="$emit( `update`, element )">
                                        <i class="fa fa-pencil-square-o me-2" aria-hidden="true"></i>Modificar
                                    </a>
                                </li>
                                <li class="cursor-pointer">
                                    <a class="dropdown-item" v-show="keys.includes( `user.destroy` )" @click="$emit( `destroy`, element )">
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
        data : Object,
    },

    computed: mapState([ `keys` ]),
}
</script>
