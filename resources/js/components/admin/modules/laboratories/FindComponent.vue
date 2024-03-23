<template>
    <form :id="`${id}Form`">
        <div class="row">
            <div class="col-md-1 col-sm-6">
                <label class="form-label">Registros</label>
                <select @change="formData()" name="rows" class="form-select form-select-sm">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-6">
                <label class="form-label">Nombre</label>
                <input @input="writing" type="text" name="name" class="form-control form-control-sm" autocomplete="off">
            </div>
            <div class="col-md-2 col-sm-6">
                <label class="form-label">Ambiente</label>
                <input @input="writing" type="text" name="ambient" class="form-control form-control-sm" autocomplete="off">
            </div>
            <div class="col-md-2 col-sm-6">
                <label class="form-label">Asignamiento</label>
                <input @input="writing" type="text" name="asignament_id" class="form-control form-control-sm" autocomplete="off">
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
        id : String,
    },

    data()
    {
        return {
            form : null
        }
    },

    mounted()
    {
        this.form = document.getElementById( `${this.id}Form` )
        this.formData()
    },

    methods:
    {
        formData()
        {
            let filts = vuenisimo.getData( this.form )
            this.$emit( `filts`, filts )
        },

        writing()
        {
            clearTimeout( this.timeout )
            let self = this
            this.timeout = setTimeout( function (){ self.formData() }, 650 )
        },
    },
}
</script>
