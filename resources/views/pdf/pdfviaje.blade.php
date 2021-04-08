<Html>
    <head>
        <title>Reporte moviles</title>

            <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
            table{
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th{
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            tr:nth-child(even){
                background-color: #dddddd;
            }
        </style>
    </head>
<body>
<h2>Reporte de Viajes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Tarifa</th>
            <th>Movil</th>
            <th>Fecha y Hora</th>
            <th>Precio</th>
        </tr>
        @foreach($viajes as $key => $viaje)
        <tr>
            <td>{{$key+1}}</td>
              <td>{{$viaje->id_user}}</td>
              <td>{{$viaje->id_servicio}}</td>
              <td>{{$viaje->id_tarifa}}</td>
              <td>{{$viaje->id_movil}}</td>
              <td>{{$viaje->created_at}}</td>
              <td>{{$viaje->precio}}</td>
        </tr>
        @endforeach
    </table>
</body>