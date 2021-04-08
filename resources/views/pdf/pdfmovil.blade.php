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
<h2>Reporte de moviles</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Usuario</th>
            <th>Parada</th>
        </tr>
        @foreach($movils as $key => $movil)
        <tr>
            <td>{{$key+1}}</td>
              <td>{{$movil->placa}}</td>
              <td>{{$movil->modelo}}</td>
              <td>{{$movil->anio}}</td>
              <td>{{$movil->id_user}}</td>
              <td>{{$movil->id_parada}}</td>
        </tr>
        @endforeach
    </table>
</body>