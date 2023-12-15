<template>
    <button class="d-none btn-submit" type="submit"></button>
    <button class="btn btn-sm me-2 mb-0 text-white" type="button" :class="(select > 1 ) ? 'bg-dark' : 'bg-secondary'" @click="before">Atrás</button>
    <button class="btn btn-sm mb-0 text-white" :class="this.select == this.elements.length ? 'btn-success' : 'btn-dark'" @click="after" :type=" this.temporal == this.elements.length ? 'submit' : 'button'">
        {{ this.select == this.elements.length ? 'Finalizar' : 'Siguiente' }}
    </button>
</template>

<script lang="js">
import vuenisimo from '../helper/vuenisimo'

export default
{
    emits : [ `before`, `after`, `go` ],

    props:
    {
        id : String,
        elements : Object,
        select : Number,
    },

    data()
    {
        return {
            temporal : null,
            form : null,
        }
    },

    mounted()
    {
        this.form = document.getElementById(this.id)
        this.submit = document.getElementsByClassName('btn-submit')[0]
    },

    methods :
    {
        before()
        {
            if( this.select > 1 )
            {
                
                this.$emit( 'before', true )
            }
        },

        message( validity )
        {
            if( validity.rangeOverflow )
            return 'Valor máximo sobrepasado'
            else if( validity.rangeUnderflow )
            return 'Valor minimo no alcanzado'
            else if( validity.tooLong )
            return 'Texto muy extenso'
            else if( validity.tooShort )
            return 'Texto muy corto'
        },

        validation()
        {
            vuenisimo.clearError( this.form )
            for (let index = 1; index <= this.select; index++)
            {
                let wizardSpace = this.form.querySelector('#wizard-space'+index)
                
                if( wizardSpace )
                {
                    let space = wizardSpace.querySelectorAll("input, select, radio, checkbox, textarea")
                    
                    for(let element of space)
                    {
                        if( element.name )
                        {
                            if( element.validity.valid == false )
                            {
                                this.$emit( 'go', index )
                                setTimeout(() => {
                                    this.submit.click()
                                }, 100);
                                return false
                            }
                        }
                    }
                }
                
            }
            return true
        },

        after()
        {
            // if( true )
            if( this.validation() )
            {
                this.temporal = this.select
                if( this.select < this.elements.length )
                this.$emit( 'after', true )
            }
        }
    },
}
</script>
