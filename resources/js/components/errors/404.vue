<template>
<section class="content area">
    <div class="container">
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="d-block text-center">
                <h1 class="text-light text-center">404</h1>
                <h6 class="text-light nt mt-30">Página no encontrada</h6>
                <p class="text-muted big-p">Al parecer la página que estas buscado no existe o está <br>fuera de servicio.</p>
                <br>
                <router-link :to="{name: 'Landing'}">
                    <button class="nt btn btn-info btn-xs btn-icon-animbtn-rounded btn-rounded">Ir al Inicio</button>
                </router-link>
            </div>
        </div>
    </div>
</section>

</template>
<script>
export default {
}
</script>