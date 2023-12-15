// CREATE BY RENZO ZAVALA
import { notify } from '@kyvg/vue3-notification'

// =============++++++++++++++++++= LOADER ==============++++++++++++++++++++
let divLoader = document.createElement( 'div' )
divLoader.classList.add( 'div-loader' )
let spinner = document.createElement( 'div' )
spinner.classList.add( 'loader' )
divLoader.appendChild( spinner )
let spin = document.createElement( 'div' )
spin.classList.add( 'loader-wheel' )
spinner.appendChild( spin )
// =====================================+++++++++++++++++++++++++++++++++++++

// ===========================================================================
//                                   LOADER
// ===========================================================================
const loader = ( area, status ) =>
{
    if( area )
    {
        if( status == true )
        {
            // Loader si es en un formulario
            if( area.nodeName == 'FORM' )
            {
                divLoader.style.opacity = 0.8
                divLoader.style.background = ''
                divLoader.style.borderRadius = '1rem'
            }
            // Loader si es en un div
            if( area.nodeName == 'DIV' )
            {
                divLoader.style.opacity = 1
                divLoader.style.background = 'transparent'
                divLoader.style.borderRadius = '0rem'
            }
            area.prepend( divLoader )
        }

        else
        {
            let remove = area.getElementsByClassName( 'div-loader' )[ 0 ]
            if( remove )
            {
                area.removeChild( remove )
            }
        }
    }
}

// ===========================================================================
//                               NOTIFICACIONES
// ===========================================================================

const storeNotification = () => 
{
    notify({
        type: `info`,
        duration: 2000,
        title: `✅ Correcto`,
        text: `Elemento creado.`,
        closeOnClick: true,
        pauseOnHover : true,
        reverse: true
    })
}

const updateNotification = () => 
{
    notify({
        type: `info`,
        duration: 2000,
        title: `✅ Correcto`,
        text: `Elemento modificado.`,
        closeOnClick: true,
        pauseOnHover : true,
        reverse: true
    })
}

const destroyNotification = () => 
{
    notify({
        type: `info`,
        duration: 2000,
        title: `✅ Correcto`,
        text: `Elemento eliminado.`,
        closeOnClick: true,
        pauseOnHover : true,
        reverse: true
    })
}

// ===========================================================================
//                               GESTIÓN DE DATA
// ===========================================================================

// ESTRACTOR DE ELEMENTOS
const getElements = ( element ) =>
{
    if( Object.getPrototypeOf( element ).constructor.name == 'HTMLFormElement' )
    return element.elements
    else if( Object.getPrototypeOf( element ).constructor.name == 'HTMLCollection' )
    return element
}


// 1) OBTENER LA DATA
const getData = ( element ) =>
{
    let result   = {}
    let elements = getElements( element )
    for( const element of elements )
    {
        if( element.getAttribute( 'name' ) )
        {
            if( element.type == 'checkbox' )
            {
                result[element.getAttribute( 'name' )] = element.checked
            }
            else if( element.type == 'radio' )
            {
                if( element.checked )
                {
                    result[ element.getAttribute( 'name' ) ] = element.value
                }
            }
            else
            {
                result[ element.getAttribute( 'name' ) ] = element.value
            }
        }
    }
    return result
}


// 2) ESTABLECER DATA
function setData( element , data )
{
    let elements = getElements( element )

    for( const element of elements )
    {
        if( element.type == 'checkbox' )
        {
            if( data[element.getAttribute( 'name' )] )
            element.checked = ( data[ element.getAttribute( 'name' ) ] == 1 || data[ element.getAttribute( 'name' ) ] == true ) ? true : false
        }
        else if( element.type == 'radio' )
        {
            if( data[ element.getAttribute( 'name' ) ] )
            element.checked = ( element.value == data[ element.getAttribute('name') ] ) ? true : null
        }
        else
        {
            if( element.type !== 'file' )
            {
                if(data[ element.getAttribute( 'name' ) ] !== undefined )
                element.value = data[ element.getAttribute( 'name' ) ]
            }
        }
    }
}


// 3) BORRAR DATA
function clearData( element )
{
    let elements = getElements( element )

    for(const element of elements)
    {        
        if( element.type == 'checkbox' )
        element.checked =  false
        else if( element.type == 'radio' )
        element.checked = null
        else
        element.value = ''
    }
}

// 4) FILTADO DE LA DATA
const filterData = ( elements, attribute, value ) =>
{
    let filteredOut = []
    elements.forEach( element => {
        if( element[ attribute ] == value )
        filteredOut.push( element )
    })
    return filteredOut
}

// 5) REEMPLAZO DE REGISTRO
const replaceData = ( list, row ) =>
{
    list.forEach((element,index) => {
        if(element.id == row.id )
        {
            for (let attribute in element)
            {
                if(row[attribute] != null)
                {
                    element[attribute] = row[attribute]
                }
            }
        }
    })
    return list
}

// ===========================================================================
//                               MANEJO DE ERRORES
// ===========================================================================

// 1) VALIDACION EN FORMULARIOS
const setError = ( element, errors ) =>
{
    if( errors.status != 403 )
    {
        let elements = element.querySelectorAll( '.error' )
        elements.forEach( element =>{
            if( errors.errors[ element.getAttribute( 'error' ) ] )
            element.innerHTML = errors.errors[ element.getAttribute( 'error' ) ]
        })
    }
}

const clearError = ( element ) => 
{
    let elements = element.querySelectorAll('.error')
    elements.forEach(element => {
        element.innerHTML = ''
    })
}

// 2) NOTIFICACION DE ERRORES
const error = ( response, form = null ) =>
{
    if(response == undefined)
    {
        notify({
            type: "error",
            duration: 2000,
            title: "<i class='fa fa-times me-2'></i>Servidor desconectado",
            text: "El servidor no responde, intentelo más tarde.",
            closeOnClick: true,
            reverse: true
        })
    }

    else
    {
        if(response.status == 403)
        {
            notify({
                type: "warn",
                duration: 2000,
                title: "🛡️ Token expirado o inválido.",
                text: 'Inicie sesión nuevamente.',
                classes: "bg-success",
                closeOnClick: true,
                reverse: true
            })
            localStorage.removeItem('user')
            window.location.href = window.location.origin
        }

        else
        {
            notify({
                type: "error",
                duration: 2000,
                title: `Error ${response.status}`,
                text: response.data.message,
                closeOnClick: true,
                reverse: true
            })
            setError( form, response.data )
        }
    }
}

const basePagination = () =>
{
    return {
        meta : {
            links : [
                { "url": null, "label": "«", "active": false },
                { "url": "", "label": "1", "active": true },
                { "url": null,"label": "»", "active": false }
            ]
        }
    }
}

const processing = ( modal, status ) =>
{
    modal._config.backdrop = !status
    modal._config.keyboard = !status
}

export default {
    loader,
    storeNotification,
    updateNotification,
    destroyNotification,
    getElements,
    getData,
    setData,
    clearData,
    filterData,
    replaceData,
    setError,
    clearError,
    error,
    basePagination,
    processing,
}