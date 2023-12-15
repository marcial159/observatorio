<template>
    <div class="bg-admin position-absolute w-100 h-100"></div>
    <sidebar></sidebar>
    <main class="main-content position-relative border-radius-lg">
        <navbar></navbar>
        <router-view v-slot="{ Component }">
            <transition name="fade">
                <component :is="Component"/>
            </transition>
        </router-view>
        <!-- <footer></footer> -->
    </main>
    <leftbar></leftbar>
</template>

<script>
import Sidebar from '../admin/Sidebar'
import Leftbar from '../admin/Leftbar'
import Navbar from '../admin/Navbar'
import Footer from '../admin/Footer'

export default
{
    components:
    {
        Sidebar,
        Leftbar,
        Navbar,
        Footer,
    },

    created()
    {
        let permissions = []
        JSON.parse(localStorage.getItem('user')).permissions.forEach(element => {
            permissions.push(element.name);
        });
        this.$store.commit('SET_KEYS', permissions )
    },

    mounted()
	{
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar'))
		{
            var options = {
            damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    },
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active
{
	transition: opacity 0.5s ease-out;
}

.fade-enter-from,
.fade-leave-to
{
  opacity: 0;
}
</style>
