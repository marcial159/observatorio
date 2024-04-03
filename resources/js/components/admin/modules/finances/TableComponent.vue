<template>
    <div class="col-12">
        <div class="table-size-1">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-th">
                    <tr>
                        <th class="col-3 text-uppercase text-xxs font-weight-bolder" role="button" title="Rubros">
                            Rubros
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" title="Total de Financiamiento">
                            Total
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" title="Gastos Realizados">
                            Gastos
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" title="Saldo">
                            Saldo
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" title="Estado">
                            Estado
                        </th>

                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" role="button" title="Fecha de modificación">
                            Fecha
                        </th>
                        <th class="col-1 text-uppercase text-xxs font-weight-bolder text-center" title="Acción">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="data?.length > 0" v-for="(element, index) in data" :key="index">
                        <td class="align-middle animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.item.name }}</small>
                        </td>
                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">S/ {{ element.amount }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">S/ {{ element.expenses }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">S/ {{ element.available_amount }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small style="width: 100px;" :class="'mb-0 text-xs badge ' + getStatusClass(element.status)">{{ element.status
                                }}</small>
                        </td>

                        <td class="align-middle text-center animate__animated animate__fadeIn">
                            <small class="mb-0 text-xs">{{ element.last_modified }}</small>
                        </td>


                        <td class="align-middle text-center"
                            v-show="keys.includes(`user.update`) || keys.includes(`user.destroy`)">
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
                                    <a class="dropdown-item" @click="$emit(`concept`, element)">
                                        <i class="fa fa-money me-2" aria-hidden="true"></i>Gastos
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

        methods: {
            getStatusClass(status) {
                if (status === 'Completado') {
                    return 'text-bg-success';
                } else if (status === 'En progreso') {
                    return 'text-bg-warning';
                } else if (status === 'Pendiente') {
                    return 'text-bg-danger';
                } else {
                    return '';
                }
            }
        }
    }
</script>
