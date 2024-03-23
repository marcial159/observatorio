<template>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <!--<a href="https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard" target="_blank">UI</a> /
                <a href="https://lineicons.com/icons/" target="_blank">Icons</a> /
                <a href="https://getbootstrap.com/docs/5.0/getting-started/introduction/" target="_blank">Bootstrap</a> /
                <a href="https://laravel.com/docs/9.x" target="_blank">Laravel</a> / 
                <a href="https://vuejs.org/guide/introduction.html" target="_blank">Vue</a> /
                <a href="https://github.com/vueform/multiselect" target="_blank">Multiselect</a>-->
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="ps-2 form-control form-control-sm" placeholder="Buscar...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="avatar avatar-sm rounded-circle border border-primary me-2" :src="avatar" alt="">
                        <small class="text-name">{{firstname }}</small>
                    </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item border-radius-md" @click="reset">
                                    <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                        <i class="lni lni-postcard"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            {{firstname}}
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                        <!-- <i class="fa fa-clock me-1"></i> -->
                                        {{role}}
                                        </p>
                                    </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" @click="logout">
                                    <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-danger  me-3  my-auto">
                                        <i class="fa fa-power-off fs-7"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Cerrar Sesión
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                        <!-- <i class="fa fa-clock me-1"></i> -->
                                        <!-- {{role}} -->
                                        </p>
                                    </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <reset-component ref="ResetComponent"></reset-component>
    </nav>
</template>
<script>
import ResetComponent from './Reset.vue'
import { mapState } from 'vuex'
export default {
    components: {
        ResetComponent,
    },

    data() {
        return {
            firstname: '',
            role: '',
            avatar: '',
        }
    },
    mounted() {
        this.firstname = JSON.parse(localStorage.getItem('user')).firstname
        this.role = JSON.parse(localStorage.getItem('user')).role.name
        this.avatar = JSON.parse(localStorage.getItem('user')).avatar ? JSON.parse(localStorage.getItem('user')).avatar : '../assets/img/user.png'
    },
    computed: mapState(['module']),
    methods:
    {
        reset()
        {
            this.$refs.ResetComponent.reset();
        },

        async logout()
        {
            localStorage.removeItem( 'user' )
            localStorage.removeItem( 'dashboard' )
            this.axios.post(this.$uri+'/logout')
            .then( response => {
            })
            .catch(error => {
            })
            this.$router.push( {name: 'AdminLogin'} )
        },
    },
}
</script>
