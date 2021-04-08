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
<h2>Reporte de promociones</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
        </tr>
        @foreach($promocions as $key => $promocion)
        <tr>
            <td>{{$key+1}}</td>
              <td>{{$promocion->name}}</td>
              <td>{{$promocion->description}}</td>
              <td>{{$promocion->fec_ini}}</td>
              <td>{{$promocion->fec_fin}}</td>
        </tr>
        @endforeach
    </table>
</body>