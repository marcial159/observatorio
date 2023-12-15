<template>
    <div v-show="data" class="mt-3">
        <p class="text-xs">Mostrando registros del {{(data.from) ? data.from : 0}} al {{(data.to) ? data.to : 0}} de un total de {{(data.total) ? data.total : 0}} registro(s)</p>
    </div>
</template>

<script>
export default {
    props: {
        data : Object
    },
}
</script>
