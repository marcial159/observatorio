<template>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <router-link class="navbar-brand m-0" :class="(route == '/admin/dashboard') ? 'active' : ''" :to="{name: 'AdminDashboard'}">
            <img :src="'../assets/img/unamba.png'" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold fs-6"> VRIN UNAMBA</span>
            <!--<small class="ms-2 text-xs">DIIT</small>-->
        </router-link>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/dashboard') ? 'active' : ''" :to="{name: 'AdminDashboard'}" @click="activate">
                        <i class="lni lni-grid-alt fs-6" :class="(route == '/admin/dashboard') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Panel de control</span>
                    </router-link>
                </li>
                <li v-show="keys.includes('role.list') || keys.includes('user.list')" class="nav-item">
                    <a data-bs-toggle="collapse" href="#personal" class="nav-link" :class="(route == '/admin/roles' || route == '/admin/users') ? 'active' : ''" aria-controls="personal" role="button" :aria-expanded="(route == '/admin/roles') ? 'true' : 'false'">
                        <i class="lni lni-users fs-6" :class="(route == '/admin/roles' || route == '/admin/users') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Personal</span>
                    </a>
                    <div class="collapse" :class="(route == '/admin/roles' || route == '/admin/users') ? 'show' : ''" id="personal">
                        <ul class="nav">
                            <li v-show="keys.includes('role.list')" class="nav-item" :class="(route == '/admin/roles') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminRoles'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Roles </span>
                                </router-link>
                            </li>
                            <li v-show="keys.includes('user.list')" class="nav-item" :class="(route == '/admin/users') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminUsers'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Usuarios </span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li v-show="keys.includes('headquarter.list') || keys.includes('faculty.list') || keys.includes('career.list') || keys.includes('laboratory.list')" class="nav-item">
                    <a data-bs-toggle="collapse" href="#university" class="nav-link" :class="(route == '/admin/headquarters' || route == '/admin/faculties' || route == '/admin/careers' || route == '/admin/laboratories') ? 'active' : ''" aria-controls="university" role="button" :aria-expanded="(route == '/admin/roles') ? 'true' : 'false'">
                        <i class="lni lni-apartment fs-6" :class="(route == '/admin/headquarters' || route == '/admin/faculties' || route == '/admin/careers' || route == '/admin/laboratories') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Universidad</span>
                    </a>
                    <div class="collapse" :class="(route == '/admin/headquarters' || route == '/admin/faculties'|| route == '/admin/careers'|| route == '/admin/laboratories') ? 'show' : ''" id="university">
                        <ul class="nav">
                            <li v-show="keys.includes('headquarter.list')" class="nav-item" :class="(route == '/admin/headquarters') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminHeadquarters'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Sedes </span>
                                </router-link>
                            </li>
                            <li v-show="keys.includes('career.list')" class="nav-item" :class="(route == '/admin/careers') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminCareers'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Carreras </span>
                                </router-link>
                            </li>
                            <li v-show="keys.includes('faculty.list')" class="nav-item" :class="(route == '/admin/faculty') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminFaculties'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Facultades </span>
                                </router-link>
                            </li>
                            <li v-show="keys.includes('laboratory.list')" class="nav-item" :class="(route == '/admin/laboratory') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminLaboratories'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Laboratorios </span>
                                </router-link>
                            </li>                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/item') ? 'active' : ''" :to="{name: 'AdminItems'}" @click="activate">
                        <i class="lni lni-coin fs-6" :class="(route == '/admin/item') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Rubros</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/announcement') ? 'active' : ''" :to="{name: 'AdminAnnouncements'}" @click="activate">
                        <i class="lni lni-cup fs-6" :class="(route == '/admin/announcement') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Concursos</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/user') ? 'active' : ''" :to="{name: 'AdminUsers'}" @click="activate">
                        <i class="lni lni-construction-hammer fs-6" :class="(route == '/admin/user') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Jurados</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/user') ? 'active' : ''" :to="{name: 'AdminUsers'}" @click="activate">
                        <i class="lni lni-handshake fs-6" :class="(route == '/admin/user') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Equipos</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/student') ? 'active' : ''" :to="{name: 'AdminStudents'}" @click="activate">
                        <i class="lni lni-graduation fs-6" :class="(route == '/admin/student') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Estudiantes</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :class="(route == '/admin/user') ? 'active' : ''" :to="{name: 'AdminUsers'}" @click="activate">
                        <i class="lni lni-library fs-6" :class="(route == '/admin/user') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Docentes</span>
                    </router-link>
                </li>
                <span class="nav-link-text ms-1">Registro y Monitoreo</span>
                <li v-show="keys.includes('role.list') || keys.includes('user.list')" class="nav-item">
                    <a data-bs-toggle="collapse" href="#institutes" class="nav-link" :class="(route == '/admin/roles' || route == '/admin/users') ? 'active' : ''" aria-controls="institutes" role="button" :aria-expanded="(route == '/admin/roles') ? 'true' : 'false'">
                        <i class="lni lni-consulting" :class="(route == '/admin/roles' || route == '/admin/users') ? 'text-success' : ''"></i>
                        <span class="nav-link-text ms-1">Institutos</span>
                    </a>
                    <div class="collapse" :class="(route == '/admin/roles' || route == '/admin/users') ? 'show' : ''" id="institutes">
                        <ul class="nav">
                            <li v-show="keys.includes('role.list')" class="nav-item" :class="(route == '/admin/roles') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminRoles'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Inv. Docente </span>
                                </router-link>
                            </li>
                            <li  class="nav-item" :class="(route == '/admin/projects') ? 'active' : ''">
                                <router-link class="nav-link" :to="{name: 'AdminProjects'}" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs" aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Inv. Estudiante </span>
                                </router-link>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item" :class="(route == '/admin/projects') ? 'active' : ''">
                                <router-link class="nav-link" :to="{ name: 'AdminProjects' }" @click="activate">
                                    <span class="sidenav-mini-icon"><i class="fa fa-circle-o text-xxs"
                                            aria-hidden="true"></i></span>
                                    <span class="sidenav-normal"> Proyectos Incubadoras</span>
                                </router-link>
                            </li>               
            </ul>
            
        </div>
    </aside>
</template>

<script>
import { mapState } from 'vuex'

export default
{
    data()
    {
        return {
            route : '/dashboard',
        }
    },

    computed: mapState( [ 'keys' ] ),

    mounted()
    {
        this.activate()
    },

    methods:
    {
        activate()
        {
            setTimeout(() => {
                this.route = this.$router.options.history.state.current
            }, 100);
        }
    },
}
</script>
