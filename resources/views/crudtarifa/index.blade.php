@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">

<div>
    <a style="margin: 15px;" href="{{ route('tarifas.create')}}" class="btn btn-primary">Nueva Tarifa</a>
</div>

<div class="row">
<div class="col-sm-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Tarifas</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Tramo</td>
          <td>Precio</td>
          <td>Promocion</td>
          <td>Servicio</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tarifas as $tarifa)
        <tr>
            <td>{{$tarifa->id}}</td>
            <td>{{$tarifa->name}}</td>
            <td>{{$tarifa->tramo}}</td>
            <td>{{$tarifa->precio}}</td>
            <td>{{$tarifa->id_promocion}}</td>
            <td>{{$tarifa->id_servicio}}</td>
            <td>
                <a href="{{ route('tarifas.edit',$tarifa->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('tarifas.destroy', $tarifa->id)}}" method="post">
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