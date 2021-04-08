@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">

  <div class="row">
  <div class="col-xs-12 col-md-12">
      @if(session()->get('success'))
          <div class="alert alert-success">
          {{ session()->get('success') }}  
          </div>
      @endif
      <h1 class="display-3">Viajes</h1>    
    <table class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>Cliente</td>
            <td>Servicio</td>
            <td>Tarifa</td>
            <td>Movil</td>
            <td>Fecha y Hora</td>
            <td>Precio</td>
            <td>Estado</td>
            <td colspan = 2>Acciones</td>
          </tr>
      </thead>
      <tbody>
          @foreach($viajes as $viaje)
          <tr>
              <td>{{$viaje->id}}</td>
              <td>{{$viaje->id_user}}</td>
              <td>{{$viaje->id_servicio}}</td>
              <td>{{$viaje->id_tarifa}}</td>
              <td>{{$viaje->id_movil}}</td>
              <td>{{$viaje->created_at}}</td>
              <td>{{$viaje->precio}}</td>
              <?php

              switch ($viaje->terminado) {
                case 0:
                    $data = "No finalizado";
                    echo '<td style="color:#FF0000" >Pendiente</td>';
                    break;
                case 1:
                    //$data = "Finalizado";
                    echo '<td>Aceptado</td>';
                    break;
                default:
                    $data = "No finalizado";
                    echo'<td style="color:#FF0000">Pendiente</td>';
                    break;
              }
            ?>
              @if($viaje->terminado)
              <td>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-default" type="submit">Aceptado</button>
                  </form>
              </td>
              @else
              <td>
                   <form action="{{ route('viajesadmin.edit', $viaje->id)}}" >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-warning" type="submit">Aceptar</button>
                  </form>
              </td>
              @endif
              <td>
                  <form action="{{ route('viajesadmin.destroy', $viaje->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
  </div>

  </div>
            </div>
        </div>
    </div>
</div>
@endsection