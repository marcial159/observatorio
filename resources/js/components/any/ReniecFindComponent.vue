<template>
    <div class="input-group">
        <span class="input-group-text text-body">
            <i class="find fas fa-search d-block text-success" aria-hidden="true"></i>
            <div class="finding spinner-border spinner-border-sm text-success d-none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <h6 class="ms-2 mb-0" style="font-size: 10px;">RENIEC</h6>
        </span>
        <input @input="search" name="document" type="text" class="form-control form-control-sm ps-2 document" maxlength="8" minlength="8" autocomplete="off">
    </div>
</template>
<script>
export default
{
    data()
    {
        return {
            enabled : true,
            response : {},
            searcher : null,
            searching : null,
            render : true,
        }
    },

    methods:
    {
        capitalize(data)
        {
            let text = data.split(' ')
            let string = ''
            let count = 0
            text.forEach( element =>
            {
                count++
                if(text.length > count)
                {
                    const firstLetter = element.charAt(0)
                    const rest = element.slice(1)
                    string = string + firstLetter.toUpperCase() + rest
                    string = string + ' '
                }
                else
                {
                    const firstLetter = element.charAt(0)
                    const rest = element.slice(1)
                    string = string + firstLetter.toUpperCase() + rest
                }
            })
            return string
        },

        async findInReniec( document )
        {
            await this.axios.get('https://dniruc.apisperu.com/api/v1/dni/'+document+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJlbnpvemF2YWxhMTIzQGdtYWlsLmNvbSJ9.dF8z6xdc06sllqie_fIkfgZ_ygrCgOI4TkXnKsgxvZc',
            {
                transformRequest: (data, headers) => {
                    delete headers.common['Authorization']
                    return data
                }
            })
            .then( response =>
            {
                this.response = {
                    'status' : 200,
                    'firstname' : this.capitalize(response.data.nombres.toLowerCase()),
                    'lastname' : this.capitalize(response.data.apellidoPaterno.toLowerCase())+' '+this.capitalize(response.data.apellidoMaterno.toLowerCase()),
                }
            })
            .catch( error =>
            {
                this.response = {
                    'status' : 404
                }
            })
        },

        async findInDatabase( document )
        {
            await this.axios.get( `${this.$uri}/person/${document}`)
            .then( response =>
            {
                this.response = {
                    'status' : 200,
                    'firstname' : response.data.firstname,
                    'lastname' : response.data.lastname,
                    'gender' : response.data.gender,
                    'email' : response.data.email,
                    'phone' : response.data.phone,
                }
            })
            .catch( error =>
            {
                this.response = {
                    'status' : 404
                }
            })
        },

        async search( e )
        {
            let searcher = document.getElementsByClassName( 'find' )[0]
            let searching = document.getElementsByClassName( 'finding' )[0]
            
            if( this.enabled )
            {
                if(e.target.value.length == 8)
                {
                    searcher.classList.add('d-none')
                    searcher.classList.remove('d-block')
                    searching.classList.add('d-block')
                    searching.classList.remove('d-none')
    
                    await this.findInDatabase( e.target.value )
                    if( this.response.status == 200 )
                    {
                        this.$emit( 'response', this.response )
                    }
                    else
                    {
                        await this.findInReniec( e.target.value )
                        if(this.response.status == 200)
                        {
                            this.$emit( 'response', this.response )
                        }
                        else
                        {
                            this.$emit( 'response', {
                                'status' : 404
                            })
                        }
                    }

                    searcher.classList.add('d-block')
                    searcher.classList.remove('d-none')
                    searching.classList.add('d-none')
                    searching.classList.remove('d-block')
                }
                else
                {
                    this.$emit( 'response', {
                        'status' : 422
                    })
                }
            }
        }    
    },
}
</script>