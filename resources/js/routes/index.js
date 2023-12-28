import { createRouter, createWebHistory } from 'vue-router'
// Vistas publicas
import Landing from '../components/public/views/Landing.vue'

// Vistas Administrador
import AdminLogin from '../components/admin/modules/auth/Login.vue'
import AdminRecover from '../components/admin/modules/auth/Recover.vue'
import AdminDashboard from '../components/admin/modules/dashboard/Index.vue'
import AdminRoles from '../components/admin/modules/roles/Index.vue'
import AdminUsers from '../components/admin/modules/users/Index.vue'
import AdminHeadquarters from '../components/admin/modules/headquarters/Index.vue'
import AdminFaculties from '../components/admin/modules/faculties/Index.vue'

// Vista de errores
import Error404 from '../components/errors/404.vue'

const routerHistory = createWebHistory()
const router = createRouter({
    history: routerHistory,
    routes: [
        { path: '/' , component: Landing, name: 'Landing' },
        // Rutas para el administrador
        { path: '/admin/login' ,component: AdminLogin, name: 'AdminLogin' },
        { path: '/admin/recover' ,component: AdminRecover, name: 'AdminRecover' },
        { path: '/admin/dashboard' ,component: AdminDashboard, name: 'AdminDashboard', meta: { requiresAuth: true } },
        { path: '/admin/roles' ,component: AdminRoles, name: 'AdminRoles', meta: { requiresAuth: true } },
        { path: '/admin/users' ,component: AdminUsers, name: 'AdminUsers', meta: { requiresAuth: true } },
        { path: '/admin/headquarters' ,component: AdminHeadquarters, name: 'AdminHeadquarters', meta: { requiresAuth: true } },
        { path: '/admin/faculties' ,component: AdminFaculties, name: 'AdminFaculties', meta: { requiresAuth: true } },
        // Rutas para errores
        { path: "/:catchAll(.*)", component: Error404 , name: '404' },
    ]
})

router.beforeEach( ( to, from, next ) => 
{
    // Si requiere autentificación
    if( to.matched.some( ( record ) => record.meta.requiresAuth ) )
    {
        if(localStorage.getItem( 'user' ))
        next()
        else
        next( {name: 'AdminLogin'} )
    }
    // Si no
    else
    {
        next()
    }
})
export default router
