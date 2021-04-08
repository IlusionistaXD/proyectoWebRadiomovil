@extends('layouts.menu')
@section('content')

<div class="container" >
    <div class="row" >
        <div class="col-md-10 offset-md-1" >
            <div class="panel panel-default" style="background-color:white;">
                <div class="panel-heading" style="text-align:center;">Estadistica</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600" style="background-color:white;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var rangoDias = <?php echo $rangoDias; ?>;
    var valores = <?php echo $valores; ?>;
    var barChartData = {
        labels: rangoDias,
        datasets: [{
            label: 'Bolivianos',
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2,
            data: valores
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");

        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 5,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Monto de dinero ganado por dia',
                    fontColor : '#222222',
                    fontSize : 16,
                }
            }
        });
    };
</script>
@endsection