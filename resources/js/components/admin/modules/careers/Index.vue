<template>
    <div class="position-absolute container-fluid" v-show="keys.includes( `career.list` )">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-start animate__animated animate__fadeInDown">
                        <h6>
                            <i class="lni lni-map-marker text-success me-2"></i>Carreras
                        </h6>
                    </div>
                    <div class="col-6 text-end mb-4">
                        <button class="btn btn-sm btn-outline-success px-3 me-2 mb-0" type="button" @click="listing()">
                            <i class="lni lni-spinner-arrow fw-bold"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-success me-2 mb-0" type="button" data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="false" aria-controls="filters">
                            <i class="lni lni-sort-amount-dsc me-1 fw-bold"></i>
                            Filtros
                        </button>
                        <button class="btn btn-sm btn-success mb-0" v-show="keys.includes( `career.store` )" @click="$refs.StoreComponent.store()">
                            <i class="lni lni-circle-plus me-1 fs-7 fw-bold"></i>
                            Nuevo
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div id="filters" class="collapse">
                        <div class="col-md-12 col-sm-12 mb-4 text-start">
                            <find-component
                            id="careerFilt"
                            @filts="e => { filters = e, listing() }"
                            />
                        </div>
                    </div>
                </div>
                <div class="row position-relative" id="careerArea">
                    <table-component
                    :data="list.data"
                    @update="e => $refs.UpdateComponent.update( e )"
                    @destroy="e => $refs.DestroyComponent.destroy( e )"
                    @order="e => { filters.parameter = e, filters.order = filters.order == `asc` ? `desc` : `asc`, listing() }"
                    />
                    <orientation-component
                    :data="list.meta"
                    />
                    <paginate-component
                    :data="list.meta.links"
                    @page="e => { page = e, listing() }"
                    />
                </div>
            </div>
        </div>
        <store-component
        id="StoreCareer"
        ref="StoreComponent"
        @reload="listing()"
        />
        <update-component
        id="UpdateCareer"
        ref="UpdateComponent"
        @row="e => replace( list.data, e )"
        />
        <destroy-component
        id="DestroyCareer"
        ref="DestroyComponent"
        @reload="listing()"
        />
    </div>
</template>

<script>
import FindComponent from './FindComponent'
import TableComponent from './TableComponent'
import StoreComponent from './StoreComponent'
import UpdateComponent from './UpdateComponent'
import DestroyComponent from './DestroyComponent'
import OrientationComponent from '../../../any/OrientationComponent'
import PaginateComponent from '../../../any/PaginateComponent'
import vuenisimo from '../../../helper/vuenisimo'
import { mapState } from 'vuex'

export default
{
    components:
    {
        FindComponent,
        TableComponent,
        StoreComponent,
        UpdateComponent,
        DestroyComponent,
        OrientationComponent,
        PaginateComponent,
    },

    data()
    {
        return {
            filters : null,
            page : 1,
            area : null,
            list : vuenisimo.basePagination(),
            replace : vuenisimo.replaceData,
        }
    },

    computed: mapState([ `keys` ]),

    mounted()
    {
        this.area = document.getElementById( `careerArea` )
    },

    methods:
    {
        listing()
        {
            vuenisimo.loader( this.area, true )
            this.axios.defaults.headers.common[ `Authorization` ] = `Bearer ${JSON.parse( localStorage.getItem( `user` ) ).token}`
            this.axios.post( `${this.$uri}/career/list?page=${this.page}`, this.filters )
            .then( response =>
            {
                this.list = response.data
            })
            .catch( error =>
            {
                vuenisimo.error( error.response )
            })
            .finally( () =>
            {
                vuenisimo.loader( this.area, false )
            })
        }
    },
}
</script>
