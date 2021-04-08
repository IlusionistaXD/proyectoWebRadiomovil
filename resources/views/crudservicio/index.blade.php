@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">

<div>
    <a style="margin: 19px;" href="{{ route('servicios.create')}}" class="btn btn-primary">Nuevo Servicio</a>
</div>

<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Servicios</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Descripcion</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($servicios as $servicio)
        <tr>
            <td>{{$servicio->id}}</td>
            <td>{{$servicio->name}}</td>
            <td>{{$servicio->description}}</td>
            <td>
                <a href="{{ route('servicios.edit',$servicio->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('servicios.destroy', $servicio->id)}}" method="post">
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