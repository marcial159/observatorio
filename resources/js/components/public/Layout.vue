<template>
    <navbar-layout/>
    <div class="container container-landing">
        <div class="row position-relative">
            <router-view v-slot="{ Component }">
            <transition name="fade">
                <component :is="Component"/>
            </transition>
            </router-view>
        </div>
    </div>
    <!-- <footer-layout/> -->
</template>

<script>
import NavbarLayout from '../public/Navbar.vue'
import FooterLayout from '../public/Footer.vue'

export default
{
    components:
    {
        NavbarLayout, 
        FooterLayout 
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease-out;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
