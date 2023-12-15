<template>
    <div class="position-absolute">
        <div class="row vh-100">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex align-items-center mt-sm-5">
                <welcome-vue></welcome-vue>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex align-items-center justify-content-center overflow-hidden">
                <animation-vue></animation-vue>
            </div>
        </div>
    </div>
</template>

<script>
import WelcomeVue from './Welcome.vue'
import AnimationVue from './Animation.vue'

export default 
{
    components:
    {
        WelcomeVue,
        AnimationVue,
    },
}
</script>
