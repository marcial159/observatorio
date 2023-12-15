<template>
    <div class="body modal-view">
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 cls-sm-12 col-xs-12 text-center">
                <strong class=""><i class="fa fa-check-circle me-2 text-info" aria-hidden="true"></i>Certificado {{data.code}} encontrado!</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr class=" mt-2 mb-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12 text-center mb-3">
                <img :src="'/assets/img/success.svg'" height="190">
                <a class="btn btn-info btn-sm mb-0 w-100 mb-2" :href="'../api/certificate/downloadFromCode/'+data.code"><i class="fa fa-download fs-6 me-1" aria-hidden="true"></i>Descargar certificado</a>
                <a class="btn btn-primary btn-sm mb-0 w-100" href="https://apps.firmaperu.gob.pe/web/validador.xhtml" target="_blank"><i class="fa fa-search fs-6 me-1" aria-hidden="true"></i>Validar firmas digitales</a>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <span class="badge-itec-alter  ps-1 pe-1 fs-7"><i class="fa fa-exclamation-circle me-1 text-info" aria-hidden="true"></i>Verifique los siguientes datos por favor</span>
                    </div>
                    <div class="col-12 text-start mb-2">
                        <strong class=" text-sm me-1 fs-6"><i class="fa fa-user-o me-2 text-info" aria-hidden="true"></i>Estudiante:</strong><small class=" text-sm">{{data.name }}</small>
                    </div>
                    <div class="col-12 text-start mb-2">
                        <strong class=" text-sm me-1"><i class="fa fa-book me-2 text-info" aria-hidden="true"></i>Evento:</strong><small class=" text-sm">{{data.event }}</small>
                    </div>
                    <div class="col-12 text-start mb-2">
                        <strong class=" text-sm me-1"><i class="fa fa-clone me-2 text-info" aria-hidden="true"></i>Tipo:</strong><small class=" text-sm">{{data.modality }}</small>
                    </div>
                    <div class="col-12 text-start mb-2" v-if="data.note">
                        <strong class=" text-sm me-1"><i class="fa fa-circle-o me-2 text-info" aria-hidden="true"></i>Nota:</strong><small class=" text-sm">{{data.note }}</small>
                    </div>
                    <div class="col-12 text-start mb-2">
                        <strong class=" text-sm me-1"><i class="fa fa-calendar-o me-2 text-info" aria-hidden="true"></i>Fecha de emisión:</strong><small class=" text-sm">{{data.emited }}</small>
                    </div>
                    <div class="col-12 text-start mb-2">
                        <div v-if="data.start && data.end">
                            <strong class=" text-sm me-1"><i class="fa fa-clock-o me-2 text-info" aria-hidden="true"></i>Duración:</strong><small class=" text-sm">
                                Del {{data.start}} al {{data.end}} ({{(data) ? data.duration : null }} horas)
                            </small>
                        </div>
                        <div v-else>
                            <strong class=" text-sm me-1"><i class="fa fa-clock-o me-2 text-info" aria-hidden="true"></i>Duración:</strong><small class=" text-sm">
                                Del {{data.start}} ({{(data) ? data.duration : null }} horas)
                            </small>
                        </div>
                    </div>
                    <!-- <div class="col-12 text-start mb-2">
                        <strong class=" text-sm me-1"><i class="fa fa-text-height me-2 text-info" aria-hidden="true"></i>Temario:</strong><small class=" text-sm" v-html="data.syllabus"></small>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data : Object,
        },
    }
</script>
