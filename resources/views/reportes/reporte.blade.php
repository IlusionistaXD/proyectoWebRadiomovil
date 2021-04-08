@extends('layouts.menu')
@section('content')

        <title>Reporte moviles</title>

            <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card" style="width: 65rem;">
                <div class="card-body">

    @if($nomTabla == 0)  <!-- Permisos -->
    <p>Clic <a href="{{ route('permisopdf') }}"> aqui</a> para descargar en PDF</p>
        <h2>Reporte de permisos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>motivo</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
            </tr>
            @foreach($permisos as $key => $permiso)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$permiso->id_user}}</td>
                <td>{{$permiso->motivo}}</td>
                <td>{{$permiso->fec_ini}}</td>
                <td>{{$permiso->fec_fin}}</td>
            </tr>
            @endforeach
        </table>
    @endif
    @if($nomTabla == 1)  <!-- Usuarios -->
    <p>Clic <a href="{{ route('userpdf') }}"> aqui</a> para descargar en PDF</p>
    <h2>Reporte de usuarios</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>CI</th>
                <th>Telefono</th>
                <th>Rol</th>
            </tr>
            @foreach($users as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->fullname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->ci}}</td>
                <td>{{$user->phone}}</td>
                <?php

              switch ($user->is_admin) {
                case 0:
                    $data = "Usuario";
                    break;
                case 1:
                    $data = "Chofer";
                    break;
                case 2:
                    $data = "Administrador";
                    break;
                }
                ?>
                <td>{{$data}}</td>
            </tr>
            @endforeach
        </table>
    @endif
    @if($nomTabla == 2)  <!-- Paradas -->
    <p>Clic <a href="{{ route('paradapdf') }}"> aqui</a> para descargar en PDF</p>
        <h2>Reporte de paradas de moviles</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Descripcion</th>
            </tr>
            @foreach($paradas as $key => $parada)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$parada->name}}</td>
                <td>{{$parada->address}}</td>
                <td>{{$parada->description}}</td>
            </tr>
            @endforeach
        </table>
    @endif
    @if($nomTabla == 3) <!-- Movils -->
    <p>Clic <a href="{{ route('movilpdf') }}"> aqui</a> para descargar en PDF</p>
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
    @endif
    @if($nomTabla == 4)  <!-- Servicios -->
    <p>Clic <a href="{{ route('serviciopdf') }}"> aqui</a> para descargar en PDF</p>
        <h2>Reporte de Servicios</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
            </tr>
            @foreach($servicios as $key => $servicio)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$servicio->name}}</td>
                <td>{{$servicio->description}}</td>
            </tr>
            @endforeach
        </table>
    @endif
    @if($nomTabla == 5)  <!-- Tarifas -->
    <p>Clic <a href="{{ route('tarifapdf') }}"> aqui</a> para descargar en PDF</p>
        <h2>Reporte de Tarifas</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tramo</th>
                <th>Precio (Bs)</th>
                <th>Promocion</th>
                <th>Servicio</th>
            </tr>
            @foreach($tarifas as $key => $tarifa)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$tarifa->name}}</td>
                <td>{{$tarifa->tramo}}</td>
                <td>{{$tarifa->precio}}</td>
                <td>{{$tarifa->id_promocion}}</td>
                <td>{{$tarifa->id_servicio}}</td>
            </tr>
            @endforeach
        </table>
    @endif
    @if($nomTabla == 6)  <!-- Promociones -->
    <p>Clic <a href="{{ route('promocionpdf') }}"> aqui</a> para descargar en PDF</p>
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
    @endif
    @if($nomTabla == 7)  <!-- Viajes -->
    <p>Clic <a href="{{ route('viajepdf') }}"> aqui</a> para descargar en PDF</p>
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
    @endif

    </div>
        </div>
    </div>
</div>
@endsection