<template>
    <div class="position-absolute container-fluid" v-show="keys.includes(`user.list`)">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-start animate__animated animate__fadeInDown">
                        <h6>
                            <i class="lni lni-users text-success me-2"></i>PROYECTOS INVESTIGACION DOCENTE
                        </h6>
                    </div>
                    <div class="col-6 text-end mb-4">
                        <button class="btn btn-sm btn-outline-success px-3 me-2 mb-0" type="button" @click="listing()">
                            <i class="lni lni-spinner-arrow fw-bold"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-success me-2 mb-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filters" aria-expanded="false" aria-controls="filters">
                            <i class="lni lni-sort-amount-dsc me-1 fw-bold"></i>
                            Filtros
                        </button>
                        <button type="button" class="btn btn-sm btn-success mb-0" v-show="keys.includes(`user.store`)"
                            @click="$refs.StoreComponent.store()">
                            <i class="lni lni-circle-plus me-1 fs-7"></i>
                            Nuevo
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div id="filters" class="collapse">
                        <div class="col-md-12 col-sm-12 mb-4 text-start">
                            <find-component @filts="e => { filters = e, listing() }" :stages="stages"
                                :contests="contests" />
                        </div>
                    </div>
                </div>
                <div class="row position-relative" id="userArea">
                    <table-component :data="list.data" @update="e => $refs.UpdateComponent.update(e)"
                        @destroy="e => $refs.DestroyComponent.destroy(e)"
                        @order="e => { filters.parameter = e, filters.order = filters.order == `asc` ? `desc` : `asc`, listing() }"
                        @file="e => $refs.FileComponent.file(e)" @report="e => this.reportItems(e)" />
                    <orientation-component :data="list.meta" />
                    <paginate-component :data="list.meta.links" @page="e => { page = e, listing() }" />
                </div>
            </div>
        </div>
        <store-component ref="StoreComponent" @reload="listing" :categories="categories" :stages="stages"
            :contests="contests" :professors="professors" :laboratories="laboratories" :students="students" />
        <update-component ref="UpdateComponent" @row="e => replace(list.data, e)" :categories="categories"
            :stages="stages" :contests="contests" :professors="professors" :laboratories="laboratories"
            :students="students" />
        <destroy-component ref="DestroyComponent" @reload="listing" />

        <file-component ref="FileComponent" />

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
import FileComponent from './FileComponent.vue'
import vuenisimo from '../../../helper/vuenisimo.js'
import { mapState } from 'vuex'

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
            FileComponent
        },

        data() {
            return {
                filters: null,
                page: 1,
                area: null,
                roles: null,
                list: vuenisimo.basePagination(),
                replace: vuenisimo.replaceData,
                categories: [],
                stages: [],
                contests: [],
                professors: [],
                laboratories: [],
                students: [],
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
                this.axios.post(`${this.$uri}/project/resources`)
                    .then(response => {
                        this.stages = response.data.stages
                        this.categories = response.data.categories
                        this.students = response.data.students
                        this.professors = response.data.professors
                        this.laboratories = response.data.laboratories
                        this.contests = response.data.contests
                    })
                    .catch(error => {
                        vuenisimo.error(error.response)
                    })
            },

            reportItems(e) {
                this.axios.post(`${this.$uri}/project/report-items`, { id: e.id }, { responseType: 'arraybuffer' })
                    .then(response => {
                        const file = new Blob([response.data], { type: 'application/pdf' });
                        const fileURL = URL.createObjectURL(file);
                        window.open(fileURL);
                    })
                    .catch(error => {
                        vuenisimo.error(error.response);
                    });
            },

            async listing() {
                vuenisimo.loader(this.area, true)
                this.axios.defaults.headers.common[`Authorization`] = `Bearer ${JSON.parse(localStorage.getItem(`user`)).token}`;
                await this.axios.post(`${this.$uri}/project/list?page=${this.page}`, this.filters)
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
