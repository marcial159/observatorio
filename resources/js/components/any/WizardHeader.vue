<template>
    <div class="wizard-header">
        <ul class="nav nav-tabs border border-0" id="myTab" role="tablist">
            <li v-for="(element, index) in elements" :key="index" class="nav-item col" role="presentation">
                <button class="btn-wizard rounded-0 nav-link border border-0 active fs-7 w-100" :class="(select == ( index + 1 )) ? 'bg-success text-dark' : 'bg-dark text-light'" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                    <i :class="element.icon" class="icon-circle text-dark me-2"></i>
                    <label class="fs-7" :class="(select == ( index + 1 )) ? 'text-dark' : 'text-light'">{{ element.text  }}</label>
                </button>
                <!-- @click="goToPage(index+1)" -->
            </li>
        </ul>
    </div>
</template>

<script lang="js">
export default
{
    props:
    {
        elements : Object,
        select : Number,
    },

    methods:
    {
        // goToPage(page)
        // {
        //     this.$emit('goToPage', page)
        // },
    },
}
</script>
