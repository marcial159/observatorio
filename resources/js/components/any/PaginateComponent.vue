<template>
    <div class="col-12" style="min-height: 36px;">
        <ul class="pagination pagination-success mt-4 ms-2">
            <li v-for="(page, index) in data" :key="index" class="page-item" :class="(page.active)? 'active' : ''">
                <button class="page-link" @click="paginate(page)" v-html="page.label"></button>
            </li>
        </ul>
    </div>
</template>

<script>
export default
{
    props:
    {
        data : Object
    },

    methods:
    {
        paginate( page )
        {
            if( page.active == false && page.url != null )
            this.$emit( 'page', page.url.split('=')[1] );
        }
    },
}
</script>
