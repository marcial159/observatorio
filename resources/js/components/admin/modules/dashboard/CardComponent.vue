<template>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-animate">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">{{title }}</p>
                            <h5 class="font-weight-bolder mb-0">
                            {{number}}
                            <span class="text-success text-sm font-weight-bolder">{{porcent }}</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center bg-success">
                            <i class="text-lg opacity-10" :class="icon" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props: {
        title : String,
        number: Number,
        porcent: String,
        icon : String,
        loading : Boolean,
    },
}
</script>
