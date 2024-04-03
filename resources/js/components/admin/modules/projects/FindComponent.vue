<template>
    <form id="userFiltForm">
        <div class="row">
            <div class="col-1">
                <label class="form-label">Registros</label>
                <select @change="formData()" name="rows" class="form-select form-select-sm">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="col-1">
                <label class="form-label">Codigo</label>
                <input @input="writing" type="text" name="code" maxlength="15" class="form-control form-control-sm"
                    autocomplete="off">
            </div>
            <div class="col-2">
                <label class="form-label">Proyecto</label>
                <input @input="writing" type="text" name="title" maxlength="100" class="form-control form-control-sm"
                    autocomplete="off">
            </div>


            <div class="col-2">
                <label class="form-label">Estados</label>
                    <select @change="formData()" name="status" class="form-select form-select-sm">
                        <option value="">-Todos los Estados-</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
            </div>

            <div class="col-2">
                <label class="form-label">Etapa</label>
                <select @change="formData()" name="stage" class="form-select form-select-sm">
                    <option value="">-Todas las Etapas-</option>
                    <option v-for="( element, index ) in stages" :key="index" :value="element.id">{{ element.name }}
                    </option>
                </select>
            </div>

            <div class="col-2">
                <label class="form-label">Concurso</label>
                <select @change="formData()" name="contest" class="form-select form-select-sm">
                    <option value="">-Todos los Concursos-</option>
                    <option v-for="( element, index ) in contests" :key="index" :value="element.id">{{ element.name
                        }}
                    </option>
                </select>
            </div>

            <div class="col-2">
                <label class="form-label">Fecha</label>
                <input @input="writing" type="date" name="date" class="form-control form-control-sm"
                    autocomplete="off">
            </div>

        </div>


    </form>
</template>

<script>
import vuenisimo from '../../../helper/vuenisimo.js'

export default
    {
        props:
        {
            stages: Array,
            contests: Array
        },

        data() {
            return {
                form: null
            }
        },

        mounted() {
            this.form = document.getElementById(`userFiltForm`)
            this.formData()
        },

        methods:
        {
            formData() {
                let filts = vuenisimo.getData(this.form)
                this.$emit(`filts`, filts)
            },

            writing() {
                clearTimeout(this.timeout)
                let self = this
                this.timeout = setTimeout(function () {
                    self.formData()
                }, 650)
            },
        },
    }
</script>
