@extends('layouts.menu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-push-8">
            <div class="card">
                <div class="card-body">

<div>
    <a style="margin: 19px;" href="{{ route('promocions.create')}}" class="btn btn-primary">Nueva Promocion</a>
</div>

<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
    <h1 class="display-3">Promociones</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Descripcion</td>
          <td>Fecha Inicio</td>
          <td>Fecha Fin</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($promocions as $promocion)
        <tr>
            <td>{{$promocion->id}}</td>
            <td>{{$promocion->name}}</td>
            <td>{{$promocion->description}}</td>
            <td>{{$promocion->fec_ini}}</td>
            <td>{{$promocion->fec_fin}}</td>
            <td>
                <a href="{{ route('promocions.edit',$promocion->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('promocions.destroy', $promocion->id)}}" method="post">
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