<template>
    <div class="position-absolute container-fluid" v-show="keys.includes(`user.list`)">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-start animate__animated animate__fadeInDown">
                        <h6>
                            <i class="lni lni-users text-success me-2"></i>SEGUIMIENTO DE FINACIERO
                        </h6>
                    </div>

                    <div class="col-6 text-end mb-4">
                        <button class="btn btn-sm btn-outline-success px-3 me-2 mb-0" type="button" @click="listing()">
                            <i class="lni lni-spinner-arrow fw-bold"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-success mb-0" v-show="keys.includes(`user.store`)"
                            @click="$refs.StoreComponent.store()">
                            <i class="lni lni-circle-plus me-1 fs-7"></i>
                            Nuevo
                        </button>
                    </div>

                    <div class="input-group col-12 mb-3 ">
                        <span class="input-group-text" style="color: white;">Codigo</span>
                        <input type="text" class="form-control" disabled style="padding-left: 10px;"
                            :value="project.code">
                        <span class="input-group-text" style="color: white;">Financiamiento</span>
                        <input disabled type="text" class="form-control" style="padding-left: 10px;"
                            :value="'S/' + project.budget">
                    </div>


                </div>
                <div class="row">
                    <div id="filters" class="collapse">
                        <div class="col-md-12 col-sm-12 mb-4 text-start">
                            <find-component @filts="e => { filters = e, listing() }" />
                        </div>
                    </div>
                </div>
                <div class="row position-relative" id="userArea">
                    <table-component :data="list.data" @update="e => $refs.UpdateComponent.update(e)"
                        @destroy="e => $refs.DestroyComponent.destroy(e)"
                        @order="e => { filters.parameter = e, filters.order = filters.order == `asc` ? `desc` : `asc`, listing() }"
                        @concept="e => $refs.ConceptComponent.concept(e)" />
                    <!-- <orientation-component :data="list.meta" />
                    <paginate-component :data="list.meta.links" @page="e => { page = e, listing() }" /> -->
                </div>
            </div>
        </div>
        <store-component ref="StoreComponent" @reload="listing" :items="items" :projectId="project.id"
            :projectItems="list.data" />
        <update-component ref="UpdateComponent" @row="e => replace(list.data, e)" :items="items" :projectId="project.id"
            :projectItems="list.data" />
        <destroy-component ref="DestroyComponent" @reload="listing" />

        <concept-component ref="ConceptComponent" @reload="listing" />

    </div>
</template>

<script lang="js">
import FindComponent from './FindComponent.vue'
import TableComponent from './TableComponent.vue'
import OrientationComponent from '../../../any/OrientationComponent.vue'
import PaginateComponent from '../../../any/PaginateComponent.vue'
import StoreComponent from './StoreComponent.vue'
import UpdateComponent from './UpdateComponent.vue'
import DestroyComponent from './DestroyComponent.vue'
import vuenisimo from '../../../helper/vuenisimo.js'
import { mapState } from 'vuex'
import { toHandlers } from 'vue'


import ConceptComponent from './ConceptComponent.vue'

export default
    {
        components:
        {
            FindComponent,
            TableComponent,
            OrientationComponent,
            PaginateComponent,
            StoreComponent,
            UpdateComponent,
            DestroyComponent,
            ConceptComponent
        },

        data() {
            return {
                filters: null,
                page: 1,
                area: null,
                items: null,
                list: vuenisimo.basePagination(),
                replace: vuenisimo.replaceData,
                project: {},
            }
        },

        computed: mapState([`keys`]),

        mounted() {
            this.area = document.getElementById(`userArea`)
            this.resources()
        },

        methods:
        {
            resources() {
                this.axios.post(`${this.$uri}/project-item/resources`, { code: this.$route.params.code })
                    .then(response => {
                        this.items = response.data.items
                        this.project = response.data.project
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
            },

            async listing() {
                vuenisimo.loader(this.area, true)
                this.axios.defaults.headers.common[`Authorization`] = `Bearer ${JSON.parse(localStorage.getItem(`user`)).token}`;

                this.filters.projectCode = this.$route.params.code

                await this.axios.post(`${this.$uri}/project-item/list?page=${this.page}`, this.filters)
                    .then(response => {
                        this.list = response.data
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
                    .finally(() => {
                        vuenisimo.loader(this.area, false)
                    })
            },
        },

    }
</script>
