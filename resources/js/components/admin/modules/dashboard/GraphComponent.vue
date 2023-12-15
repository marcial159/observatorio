<template>
    <div class="col-lg-8 col-md-6 mb-4">
        <div class="card z-index-2  ">
            <div class="card-header position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="shadow-success border-radius-lg py-3 pe-1">
                    <div id="chart">
                        <canvas id="chart-line" class="chart-canvas" height="345"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 "> Tesis de pregrado e Instigaciones docente</h6>
                <p class="text-sm ">Por escuelas académicas profesionales. </p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="lni lni-alarm-clock me-2"></i>
                    <p class="mb-0 text-sm">Actualizado hasta su ultimo inicio de sesión</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            data : null
        }
    },
    mounted()
    {
        this.data = JSON.parse(localStorage.getItem('dashboard'))
        this.resources()
    },

    unmounted()
    {
        let element = document.getElementById('chart-line');
        if(element)
        {
            element.remove();
            let div = document.getElementById('chart');
            let char = document.createElement("canvas")
            char.id = 'chart-line'
            char.class = 'chart-canvas'
            char.height = '230'
            div.appendChild(char)
        }
    },

    methods:
    {
        resources()
        {
            var ctx1 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
            new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                legend: {
                    display: false,
                }
                },
                interaction: {
                intersect: false,
                mode: 'index',
                },
                scales: {
                y: {
                    grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                    },
                    ticks: {
                    display: true,
                    padding: 10,
                    color: '#fbfbfb',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                    }
                },
                x: {
                    grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                    },
                    ticks: {
                    display: true,
                    color: '#ccc',
                    padding: 20,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                    }
                },
                },
            },
            });
        },
    },
}
</script>
