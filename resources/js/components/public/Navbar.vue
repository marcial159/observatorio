<template>
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
        <div class="container">
            <router-link class="navbar-brand m-0" :to="{name: 'Landing'}">
                <img :src="'../assets/img/Unamba.png'" class="navbar-brand-img w-25" alt="main_logo">
                <span class="ms-1 font-weight-bold fs-5">UNAMBA</span>
                <!--<small class="ms-2 fs-7">V 2.0</small>-->
            </router-link>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto">
                    <li>
                        <button class="btn btn-sm btn-outline-success me-2" @click="theme">
                            <i id="theme" class="lni lni-sun me-1 fs-7" role="button"></i>
                            Tema
                        </button>
                    </li>
                    <li class="nav-item ms-lg-auto my-auto ms-3 ms-lg-0 mt-2 mt-lg-0">
                        <router-link class="btn btn-sm btn-success text-dark mb-0 me-1 mt-2 mt-md-0" v-if="currentRouteName != 'AdminLogin' && currentRouteName != 'AdminRecover'" @click="close" :to="{name: 'AdminLogin'}">
                            Iniciar sesión
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
        
<script>
export default {
    data() {
        return {
            menu: null,
            doc: null,
            toggle: null,
            label: null,
            sun: null,
            moon: null,
        }
    },

    mounted() {
        this.menu = document.getElementById('menu')
        this.doc = document
        this.init()
    },

    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },

    methods: {
        close: function()
        {
            if(this.menu)
            {
                this.menu.click()
            }
        },

        init()
        {
            let theme = localStorage.getItem('theme')
            let body = document.getElementsByTagName('body')[0]
            let icon = document.getElementById('theme')

            if(theme == 1)
            {
                icon.classList.add('lni-sun')
                icon.classList.remove('lni-night')
                body.classList.remove('dark-version') 
            }
            else
            {
                icon.classList.remove('lni-sun')
                icon.classList.add('lni-night')
                body.classList.add('dark-version')
            }
        },

        theme(e)
        {
            e.preventDefault()
            let icon = document.getElementById('theme')
            let body = document.getElementsByTagName('body')[0]
            
            if(icon.classList.contains( 'lni-sun' ))
            {
                icon.classList.remove('lni-sun')
                icon.classList.add('lni-night')
                body.classList.add('dark-version')
                localStorage.setItem('theme',0)
            }
            else
            {
                icon.classList.add('lni-sun')
                icon.classList.remove('lni-night')
                body.classList.remove('dark-version')                
                localStorage.setItem('theme',1)
            }
        }
    },
}
</script>
