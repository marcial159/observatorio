<template>
    <notifications style="top: 5px"/>
    <component :is="(this.$route.meta.requiresAuth) ? 'AdminLayout' : 'PublicLayout'"></component>
</template>

<script>
import PublicLayout from './components/public/Layout'
import AdminLayout from './components/admin/Layout'
// import UserLayout from './components/user/Layout.vue'

export default
{
    components:
    {
        PublicLayout,
        AdminLayout,
    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>