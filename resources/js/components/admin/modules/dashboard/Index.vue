<template>
    <div class="position-absolute container-fluid overflow-hidden">
        <div class="row">
            <card-component class="animate__animated animate__slideInLeft" :title="'Invest. docente'" :number="data.investigation_count" :icon="'ni ni-hat-3'"></card-component>
            <card-component class="animate__animated animate__slideInUp" :title="'Doc. almacenados'" :number="data.document_count" :icon="'ni ni-book-bookmark'"></card-component>
            <card-component class="animate__animated animate__slideInDown" :title="'Tesis de pregrado'" :number="data.thesis_count" :icon="'ni ni-paper-diploma'"></card-component>
            <card-component class="animate__animated animate__slideInRight" :title="'Usuarios'" :number="data.user_count" :icon="'ni ni-money-coins'"></card-component>
        </div>
        <div class="row my-4">
            <!-- <table-component></table-component> -->
            <graph-component class="animate__animated animate__fadeInUp"></graph-component>
            <list-component class="animate__animated animate__fadeInUp" :list="list"></list-component>
        </div>
    </div>
</template>

<script>
import CardComponent from '../dashboard/CardComponent'
import TableComponent from '../dashboard/TableComponent'
import ListComponent from '../dashboard/ListComponent'
import GraphComponent from '../dashboard/GraphComponent'
import { mapState } from 'vuex'

export default
{
    data()
    {
        return{
            list : null,
            data : {},
            role : null,
        }
    },

    components:
    {
        CardComponent,
        TableComponent,
        ListComponent,
        GraphComponent,
    },

    computed: mapState([ 'keys' ]),

    mounted()
    {
        this.data = JSON.parse(localStorage.getItem('dashboard'))
        this.role = JSON.parse(localStorage.getItem('user')).permissions[0].name
        this.resources(this.data)
    },

    methods:
    {
        resources: function(data)
        {
            if(data)
            {
                this.list = {
                    'Sedes' : data.headquarter_count,
                    'Facultades' : data.faculty_count,
                    'Carreras' : data.career_count,
                    'Laboratorios' : data.laboratory_count,
                    'Convocatorias' : data.announcement_count,
                    'Roles' : data.role_count,
                    'Usuarios' : data.user_count,
                }
            }
        }
    }
}
</script>
